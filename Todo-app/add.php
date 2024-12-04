<?php
include 'database.php';
$db = new Database();
$conn = $db->getConnection();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];
    $conn->query("INSERT INTO tasks (task) VALUES ('$task')");
    header('Location: index.php');
}
?>
