<?php
// Simulate a POST request with the 'action' parameter
// $_SERVER['REQUEST_METHOD'] = "POST";
// $_POST['action'] = 'get_inhouse_guestlist';
// require_once 'third_party/__libs/_database.php';  // Include database connection
// require_once 'third_party/Controller/ApiController.php';
// include 'third_party/index.php';

// Check if the HTTP_AUTH_USER and HTTP_AUTH_PW are provided
// if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
//     // If not, send a 401 Unauthorized response with a WWW-Authenticate header
//     header('HTTP/1.1 401 Unauthorized');
//     header('WWW-Authenticate: Basic realm="Restricted Area"');
//     echo 'You need to enter a valid username and password to access this page.';
//     exit; // Stop the script
// }

// // Assuming we have a predefined username and password (e.g., admin/admin)


// // Check if the provided username and password are correct
// if ($_SERVER['PHP_AUTH_USER'] == $valid_user && $_SERVER['PHP_AUTH_PW'] == $valid_password) {
//     echo 'Welcome, ' . htmlspecialchars($_SERVER['PHP_AUTH_USER']) . '!';
// } else {
//     // If the credentials don't match, show an error message
//     header('HTTP/1.1 401 Unauthorized');
//     echo 'Invalid username or password!';
//     exit;
// }

phpinfo();


?>


