<?php
session_start(); // Start the session

// Get the raw POST data
$rawData = file_get_contents("php://input");
  // Log the raw data received

// Decode the JSON data into a PHP associative array
$data = json_decode($rawData, true);

// If data is decoded successfully, store it in the session
if ($data) {

    $_SESSION['user_data'] = $data; // Store the data in the session

    // Optionally send a response back to the client
    echo json_encode(['status' => 'success', 'message' => 'Data received']);
} else {
    echo 'No valid data received from the client.';
}

?>
