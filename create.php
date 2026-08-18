<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');

if ($title === '') {
    // minimal validation
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("INSERT INTO tasks (title, description) VALUES (:title, :description)");
$stmt->execute([
    ':title' => $title,
    ':description' => $description ?: null,
]);

header('Location: index.php');
exit;
