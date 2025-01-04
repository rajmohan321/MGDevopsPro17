<?php
include_once 'Session.class.php';

// Second method like without javascript 
Session::start();
// session_start(); // Start the session

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    // $first_name = $_POST['first_name'];
    // $last_name = $_POST['last_name'];
    // $email = $_POST['email'];
    // $age = $_POST['age'];
    // $password = $_POST['password'];
    
    Session::set('first_name',$_POST['first_name']);
    Session::set('last_name',$_POST['last_name']);
    Session::set('email',$_POST['email']);
    Session::set('age',$_POST['age']);
    Session::set('password',$_POST['password']);


    // Redirect to action.php
    header('Location: action.php');
    exit();
} else {
    // If the form is not submitted correctly, redirect back to the form page
    header('Location: index.php');
    exit();
}


// session_start(); // Start the session

// // Get the raw POST data
// $rawData = file_get_contents("php://input");
//   // Log the raw data received

// // Decode the JSON data into a PHP associative array
// $data = json_decode($rawData, true);

// // If data is decoded successfully, store it in the session
// if ($data) {

//     $_SESSION['user_data'] = $data; // Store the data in the session

// } else {
//     echo 'No valid data received from the client.';
// }

?>
