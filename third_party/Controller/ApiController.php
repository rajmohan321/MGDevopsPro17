<?php
require_once 'Models/Collecting.php';
//require_once 'Models/User.php';
require_once 'index.php';
class ApiController {
    
    private $bookingModel;
    
    public function __construct() {
        $this->bookingModel = new Booking();
    }

    public function createsBooking() {
      
        // $bookingId = $this->bookingModel-> ;

        // echo "Booking created successfully with ID: " . json_encode($bookingId,JSON_PRETTY_PRINT);
    }

    public function viewsBookings() {
          
        // foreach ($bookings as $booking) {
        //     echo "Booking ID: " . $booking['id'] . "<br>";
        //     echo "User ID: " . $booking['user_id'] . "<br>";
        //     echo "Service ID: " . $booking['service_id'] . "<br>";
        //     echo "Booking Date: " . $booking['booking_date'] . "<br><hr>";
        // }
        // return $bookings;

          return ($this->bookingModel->get_guest_bill());

    }
   
}
?>
