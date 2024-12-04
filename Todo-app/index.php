<?php
include 'database.php';

$db = new Database();
$conn = $db->getConnection();
// Fetch tasks
$result = $conn->query("SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>To-Do List</h1>
    <form action="add.php" method="POST">
        <input type="text" name="task" placeholder="Add a new task" required>
        <button type="submit">Add</button>
    </form>
   
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
        <li>
            <span <?php if ($row['is_completed']) echo 'style="text-decoration: line-through;"'; ?>>
                <?php echo $row['task']; ?>
            </span>
            <a href="update.php?id=<?php echo $row['id']; ?>">✔</a>
            <a href="delete.php?id=<?php echo $row['id']; ?>">✖</a>
           
        </li>
                    

        <?php endwhile; ?>
    </ul>
</body>
</html>
