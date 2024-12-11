<?php
 include 'Util/Validation.class.php';
include 'Models/Availability.php';
class Booking {
    protected $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    public function createBooking($userId, $agentId, $serviceId, $bookingDate,$startDate,$endDate) {
        
        $userId =Validation::clean($userId);
        $agentId =Validation::clean($agentId);
        $serviceId =Validation::clean($serviceId);
        $bookingDate =Validation::validDate($bookingDate);
        $startDate = Validation::validDate($startDate);
        $endDate =Validation::validDate($endDate);

      
        // Insert booking into the database
        // $stmt = $this->db->prepare("INSERT INTO bookings (user_id, agent_id, service_id, booking_date, status) VALUES (?, ?, ?, ?, 'pending')");
        // $stmt->bind_param("iiis", $userId, $agentId, $serviceId, $bookingDate);
        // $stmt->execute();
        // return $stmt->insert_id;
        // checking whether excute method working or not 

           $stmt = $this->db->prepare("INSERT INTO bookings (user_id, agent_id, service_id, booking_date, status) VALUES (?, ?, ?, ?, 'pending')");
               
                $stmt->bind_param("iiis", $userId, $agentId, $serviceId, $bookingDate);

                if (!$stmt->execute()) {
                die('Execute failed: ' . $stmt->error);
            }

            // return $stmt->insert_id;
            $insertId = $stmt->insert_id;

// You can return all the data that was inserted, including the generated insert_id
        $insertedData = [
             'insertId' => $insertId,
             'user_id' => $userId,
             'agent_id' => $agentId,
             'service_id' => $serviceId,
             'booking_date' => $bookingDate,
            'status' => 'pending'
        ];

// Return the array of inserted data
       return $insertedData;

    }

    public function getAllBookings() {
        $result = $this->db->query("SELECT * FROM bookings");
        return $result->fetch_all(MYSQLI_ASSOC);
    }


}
  
?>
