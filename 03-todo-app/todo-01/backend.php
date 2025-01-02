<?php
/*
|----------------------------------------------------------------------
| backend.php
|----------------------------------------------------------------------
| Backend PHP server
*/

require_once './apipw.php';

$host = 'localhost';
$dbname = 'todo';
$username = 'csylvester';
$password = DATABASE_PW;

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Could not connect to the database: " . $e->getMessage());
}

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

if ($action === 'getTasks') {
  $stmt = $pdo->query('SELECT * FROM task ORDER BY created_at DESC');
  echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} elseif ($action === 'addTask') {
  $data = json_decode(file_get_contents('php://input'), true);
  $task = $data['task'] ?? '';
  if ($task) {
    $stmt = $pdo->prepare('INSERT INTO task (task) VALUES (:task)');
    $stmt->execute(['task' => $task]);
    echo json_encode(['success' => true]);
  }
} elseif ($action === 'deleteTask') {
  $id = $_GET['id'] ?? 0;
  if ($id) {
    $stmt = $pdo->prepare('DELETE FROM task WHERE id = :id');
    $stmt->execute(['id' => $id]);
    echo json_encode(['success' => true]);
  }
}
