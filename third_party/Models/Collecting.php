<?php
 //include 'Util/Validation.class.php';
//include 'Models/Availability.php';

class Booking {
    protected $db;
    
    public function __construct() {
        $this->db = new Database();
    }
     public  function get_guest_bill(){
        $stmt = $this->db->prepare("SELECT * FROM guest_register Where bill_status = 1");
        // $stmt->bind_param("i", $bill_Status);
        $stmt->execute();
       
        return $stmt->get_result()->fetch_assoc();
     }
}
?>
