<?php
include 'database.php';
$db = new Database();
$conn = $db->getConnection();
$id = $_GET['id'];
$conn->query("DELETE FROM tasks WHERE id = $id");
header('Location: index.php');
?>
