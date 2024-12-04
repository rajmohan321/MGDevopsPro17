<?php
include 'database.php';
$db = new Database();
$conn = $db->getConnection();
$id = $_GET['id'];
$conn->query("UPDATE tasks SET is_completed = !is_completed WHERE id = $id");
header('Location: index.php');
?>
