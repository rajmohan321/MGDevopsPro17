<?php
require_once 'Models/Booking.php';
require_once 'Models/User.php';
require_once 'index.php';
class BookingController {
    
    private $bookingModel;
    
    public function __construct() {
        $this->bookingModel = new Booking();
    }

    public function createsBooking() {
        // assuming data comes via POST (in a real app)

        $userId = $_POST['user_id'];
        $agentId = $_POST['agent_id'];
        $serviceId = $_POST['service_id'];
        $bookingDate = $_POST['booking_date'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        // for demo purpose i am using all with post but it not safe;
        // $start_date = $_POST['start_date'];
        // $end_date = $_POST['end_Date'];

        $bookingId = $this->bookingModel->createBooking($userId, $agentId, $serviceId, $bookingDate,$start_date,$end_date);

        echo "Booking created successfully with ID: $bookingId";
    }

    public function viewsBookings() {
        $bookings = $this->bookingModel->getAllBookings();
        foreach ($bookings as $booking) {
            echo "Booking ID: " . $booking['id'] . "<br>";
            echo "User ID: " . $booking['user_id'] . "<br>";
            echo "Service ID: " . $booking['service_id'] . "<br>";
            echo "Booking Date: " . $booking['booking_date'] . "<br><hr>";
        }
        return $bookings;
    }
   
}
?>
