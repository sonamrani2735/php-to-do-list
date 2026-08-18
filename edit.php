<?php
require_once 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // update title and description
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    if ($title === '') {
        header('Location: edit.php?id='.$id);
        exit;
    }
    $stmt = $pdo->prepare("UPDATE tasks SET title = :title, description = :description WHERE id = :id");
    $stmt->execute([
        ':title' => $title,
        ':description' => $description ?: null,
        ':id' => $id,
    ]);
    header('Location: index.php');
    exit;
}

// handle mark done / undone quick actions
if (isset($_GET['action']) && in_array($_GET['action'], ['done','undone'])) {
    $is_done = $_GET['action'] === 'done' ? 1 : 0;
    $stmt = $pdo->prepare("UPDATE tasks SET is_done = :is_done WHERE id = :id");
    $stmt->execute([':is_done' => $is_done, ':id' => $id]);
    header('Location: index.php');
    exit;
}

// show edit form
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
$stmt->execute([':id' => $id]);
$task = $stmt->fetch();
if (!$task) {
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Task</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Edit Task</h1>
    <form action="edit.php?id=<?= $task['id'] ?>" method="post" class="edit-form">
      <label>Title
        <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
      </label>
      <label>Description
        <input type="text" name="description" value="<?= htmlspecialchars($task['description']) ?>">
      </label>
      <button type="submit">Save</button>
      <a href="index.php" class="btn">Cancel</a>
    </form>
  </div>
</body>
</html>
