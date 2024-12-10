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
$startDate = $_POST['start_date'];
$end_Date = $_POST['end_date'];

// Routing example
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create_booking':
                $result = $bookingController->createsBooking($_POST['user_id'], $_POST['service_id'],$startDate,$end_Date);
                echo $result;
                break;

            case 'view_bookings':
                $bookings = $bookingController->viewsBookings($_POST['user_id']);
                print_r($bookings);
                break;
        }
    }
}
?>
    
</body>
</html>

