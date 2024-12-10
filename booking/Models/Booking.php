<?php
// include 'Util/Validation.class.php';
include 'Models/Availability.php';
class Booking {
    protected $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    public function createBooking($userId, $agentId, $serviceId, $bookingDate,$startDate,$endDate) {
       
        // $availabilityModel = new Availability();
        $userId =$userId;
        $agentId = $agentId;
        $serviceId = $serviceId;
        $bookingDate = $bookingDate;
        $startDate = $startDate;
        $endDate = $endDate;

        // Check availability
        // if (!$availabilityModel->checkAvailability($agentId, $startDate, $endDate)) {
        //     throw new Exception("Agent is not available for the selected dates.");
        // }
        //this code is for checking user for demo purpose only 
        // $checkUserQuery = $this->db->prepare("SELECT id FROM users WHERE id = ?");
        // $checkUserQuery->bind_param("i", $userId);
        // $checkUserQuery->execute();
        // $result = $checkUserQuery->get_result();
               //       if ($result->num_rows === 0) {
        //           die("User with ID $userId does not exist.");
        //       }

        // Insert booking into the database
        $stmt = $this->db->prepare("INSERT INTO bookings (user_id, agent_id, service_id, booking_date, status) VALUES (?, ?, ?, ?, 'pending')");
        $stmt->bind_param("iiis", $userId, $agentId, $serviceId, $bookingDate);
        $stmt->execute();
        return $stmt->insert_id;
        // checking whether excute method working or not 

           // $stmt = $this->db->prepare("INSERT INTO bookings (user_id, agent_id, service_id, booking_date, status) VALUES (?, ?, ?, ?, 'pending')");
               
        //         $stmt->bind_param("iiis", $userId, $agentId, $serviceId, $bookingDate);

        //         if (!$stmt->execute()) {
        //         die('Execute failed: ' . $stmt->error);
        //     }

            return $stmt->insert_id;

    }

    public function getAllBookings() {
        $result = $this->db->query("SELECT * FROM bookings");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

//  // Delete a booking  for (admin function)
//  public function deleteBooking($bookingId) {
//     $stmt = $this->db->prepare("DELETE FROM bookings WHERE id = ?");
//     $stmt->bind_param("i", $bookingId);
//     $stmt->execute();
// }
}
  
?>
