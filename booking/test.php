<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require_once '__libs/_database.php';  // Include database connection
require_once 'Controller/BookingController.php';
require_once('Models/User.php');
$user_id=1;
?><pre><?php  
    $bookings = $bookingController->viewsBookings($user_id);
     echo json_encode($bookings,JSON_PRETTY_PRINT);
?></pre>
</body>
</html>

