<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require_once '__libs/_database.php';
require_once 'Controller/BookingController.php';
require_once 'Models/User.php';
require_once 'index.php';

$bookingController = new BookingController();
$userController = new User();
$_POST['action'] = "view_bookings";
$_POST['user_id'] = 1;
$_POST['service_id'] = 2;
$_POST['start_date'] = '2024/12/04';
$_POST['end_date'] ='2025/01/15';
echo $startDate;
// Routing example
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
         if($_POST['action'] == 'create_booking') {
                echo "Creating View booking";
                printf("<br>");
                $result = $bookingController->createsBooking($_POST['user_id'], $_POST['service_id'], $_POST['start_date'], $_POST['end_date']);
                echo $result;
         }else if($_POST['action'] == "view_bookings"){
           
                echo "Booking View";
                $bookings = $bookingController->viewsBookings($_POST['user_id']);
                print_r($bookings);
        }
  }else{
    echo "no action required";
  }
}



?>
</body>
</html>

