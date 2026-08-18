<?php
require_once 'db.php';

// fetch tasks
$stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
$tasks = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>PHP To-Do List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>To-Do List</h1>

    <form action="create.php" method="post" class="create-form">
      <input type="text" name="title" placeholder="Task title" required>
      <input type="text" name="description" placeholder="Description (optional)">
      <button type="submit">Add Task</button>
    </form>

    <ul class="tasks">
      <?php if (count($tasks) === 0): ?>
        <li class="empty">No tasks yet.</li>
      <?php else: ?>
        <?php foreach ($tasks as $task): ?>
          <li class="<?= $task['is_done'] ? 'done' : '' ?>">
            <div class="task-main">
              <strong><?= htmlspecialchars($task['title']) ?></strong>
              <div class="meta"><?= htmlspecialchars($task['description']) ?></div>
            </div>
            <div class="actions">
              <?php if (!$task['is_done']): ?>
                <a href="edit.php?id=<?= $task['id'] ?>&action=done" class="btn">Mark done</a>
              <?php else: ?>
                <a href="edit.php?id=<?= $task['id'] ?>&action=undone" class="btn">Mark undone</a>
              <?php endif; ?>
              <a href="edit.php?id=<?= $task['id'] ?>" class="btn">Edit</a>
              <a href="delete.php?id=<?= $task['id'] ?>" class="btn danger" onclick="return confirm('Delete this task?')">Delete</a>
            </div>
          </li>
        <?php endforeach; ?>
      <?php endif; ?>
    </ul>
  </div>
</body>
</html>
