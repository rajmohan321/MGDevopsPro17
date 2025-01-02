<?php
session_start();
    
    if (isset($_SESSION['user_data'])) {
        $data = $_SESSION['user_data'];
        echo "<h1>Received Data:</h1>";
        echo "<p><strong>First Name:</strong> " . htmlspecialchars($data['first_name']) . "</p>";
        echo "<p><strong>Last Name:</strong> " . htmlspecialchars($data['last_name']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($data['email']) . "</p>";
        echo "<p><strong>Age:</strong> " . htmlspecialchars($data['age']) . "</p>";
        echo "<p><strong>Password:</strong> " . htmlspecialchars($data['password']) . "</p>";
    } else {
        // If not a POST request, redirect back to the form page
        echo '<p> Error : NO Data Recieved from the json</p>';
    }
    session_destroy();
?>

