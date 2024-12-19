<?php
require_once 'Models/Collect_Data.php';

class ApiController{
    
    private $bookingModel;
    
    public function __construct() {
        $this->bookingModel = new Booking();
    }


    public function viewsBookings() {
          
        // foreach ($bookings as $booking) {
        //     echo "Booking ID: " . $booking['id'] . "<br>";
        //     echo "User ID: " . $booking['user_id'] . "<br>";
        //     echo "Service ID: " . $booking['service_id'] . "<br>";
        //     echo "Booking Date: " . $booking['booking_date'] . "<br><hr>";
        // }
        // return $bookings;

           $this->bookingModel->get_guest_bill();

    }
   
}
?>
