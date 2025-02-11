<?php
include_once 'Session.class.php';
Session::start();
// session_start(); // Start the session

// Check if the session variables are set
if (isset($_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['email'], $_SESSION['age'], $_SESSION['password'])) {
    echo "<h1>Form Data Submitted</h1>";
    echo "First Name: " . $_SESSION['first_name'] . "<br>";
    echo "Last Name: " . $_SESSION['last_name'] . "<br>";
    echo "Email: " . $_SESSION['email'] . "<br>";
    echo "Age: " . $_SESSION['age'] . "<br>";
    // Never display plain passwords in real applications
    echo "Password: " . $_SESSION['password'] . "<br>";
} else {
    echo "No data found. Please submit the form first.";
}

// Optionally, you can clear the session data after displaying it
Session::unset();
Session::destroy();
?>






<!-- <?php
        // session_start();

        //     if (isset($_SESSION['user_data'])) {
        //         $data = $_SESSION['user_data'];
        //         echo "<h1>Received Data:</h1>";
        //         echo "<p><strong>First Name:</strong> " . htmlspecialchars($data['first_name']) . "</p>";
        //         echo "<p><strong>Last Name:</strong> " . htmlspecialchars($data['last_name']) . "</p>";
        //         echo "<p><strong>Email:</strong> " . htmlspecialchars($data['email']) . "</p>";
        //         echo "<p><strong>Age:</strong> " . htmlspecialchars($data['age']) . "</p>";
        //         echo "<p><strong>Password:</strong> " . htmlspecialchars($data['password']) . "</p>";
        //     } else {
        //         // If not a POST request, redirect back to the form page
        //         echo '<p> Error : NO Data Recieved from the json</p>';
        //     }
        //     session_destroy();
        ?> -->