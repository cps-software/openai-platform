<?php

require_once './apipw.php';

$host = 'localhost';
$user = 'csylvester';
$password = DATABASE_PW;
$dbname = 'todo';

// Create a connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Add a new task
  $task = $_POST['task'];
  $stmt = $conn->prepare("INSERT INTO task (task) VALUES (?)");
  $stmt->bind_param("s", $task);
  $stmt->execute();
  echo json_encode(['id' => $stmt->insert_id, 'task' => $task]);
  $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
  // Retrieve all tasks
  $result = $conn->query("SELECT * FROM task ORDER BY created_at DESC");
  $tasks = [];
  while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
  }
  echo json_encode($tasks);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  // Delete a task
  parse_str(file_get_contents("php://input"), $_DELETE);
  $id = $_DELETE['id'];
  $stmt = $conn->prepare("DELETE FROM task WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  echo json_encode(['success' => true]);
  $stmt->close();
}

$conn->close();
