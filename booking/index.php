<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
</head>
<body>
<?php
require_once '__libs/_database.php';  // Include database connection
require_once 'Controller/BookingController.php';
require_once('Models/User.php');

// Initialize controllers
$bookingController = new BookingController();
$userController = new User();
$data = json_decode(file_get_contents("php://input"),true);
if($data){
    $action = $data['action'];
    $user_id = $data['user_id'];
    $agent_id = $data['agent_id'];
    $service_id = $data['service_id'];
    $booking_date = $data['booking_date'];
    $start_date = $data['start_date'];
    $end_date = $data['end_date'];   
}



// Routing example
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        switch ($action) {
            case 'create_booking':
                $result = $bookingController->createsBooking($user_id, $agent_id,$service_id,$booking_date,$start_date,$end_date);
                echo $result;
                break;

            case 'view_bookings':
                $bookings = $bookingController->viewsBookings();
               ?><pre><?php  echo json_encode($bookings,JSON_PRETTY_PRINT); ?></pre><?php 
                break;
        }
    }

?>
    
</body>
</html>

