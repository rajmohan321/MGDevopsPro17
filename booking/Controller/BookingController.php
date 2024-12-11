<?php
require_once 'Models/Booking.php';
require_once 'Models/User.php';
require_once 'index.php';
class BookingController {
    
    private $bookingModel;
    
    public function __construct() {
        $this->bookingModel = new Booking();
    }

    public function createsBooking($user_id, $agent_id,$service_id,$booking_date,$start_Date,$end_Date) {
        // assuming data comes via POST (in a real app)
        // $userId = $_POST['user_id'];
        // $agentId = $_POST['agent_id'];
        // $serviceId = $_POST['service_id'];
        // $bookingDate = $_POST['booking_date'];
        // $start_date = $_POST['start_date'];
        // $end_date = $_POST['end_date'];
        $userId= $user_id;
        $agentId = $agent_id;
        $serviceId = $service_id;
        $bookingDate=$booking_date;
        $start_date = $start_Date;
        $end_date=$end_Date;

        $bookingId = $this->bookingModel->createBooking($userId, $agentId, $serviceId, $bookingDate,$start_date,$end_date);

        echo "Booking created successfully with ID: " . json_encode($bookingId,JSON_PRETTY_PRINT);
    }

    public function viewsBookings($User_id) {
          $user_id =$User_id;
          
        // foreach ($bookings as $booking) {
        //     echo "Booking ID: " . $booking['id'] . "<br>";
        //     echo "User ID: " . $booking['user_id'] . "<br>";
        //     echo "Service ID: " . $booking['service_id'] . "<br>";
        //     echo "Booking Date: " . $booking['booking_date'] . "<br><hr>";
        // }
        // return $bookings;

        return $this->bookingModel->getAllBookings();

    }
   
}
?>
