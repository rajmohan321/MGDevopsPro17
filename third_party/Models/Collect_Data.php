<?php

class Booking {
    protected $db;
  
    public function __construct() {
        $this->db = new Database();
    }
   
     public function get_guest_bill(){
       
        $stmt = $this->db->prepare("SELECT * FROM guest_register");
        $stmt->execute();
        $result = $stmt->get_result();

        $data = array();
        $hotelname =  $this->get_hotel_name();
        $pass_word = "123456";
        // Fetch all rows from the result
        while ($row = $result->fetch_assoc()) {
           
            // $pass_word = isset($row['password'])?$row['password']:'123456';
            $data[] = [
                'HotelName'=> $hotelname,
                'RoomNo'=>$row['room_no'],
                'Password'=>$pass_word,
                'guest_name'=>$row['guest_name'],
                'phone'=>$row['phone']
            ];
        }
        echo "RoomData:".json_encode($data,JSON_PRETTY_PRINT);
        
     }
     public function get_hotel_name(){
        // Prepare and execute query to get hotel name
        $query = $this->db->prepare("SELECT prop_name FROM property_definition LIMIT 1");
        $query->execute();
        
        // Get the result and fetch the single row
        $result = $query->get_result();
        
        // If there is at least one row, return the hotel name
        if ($row = $result->fetch_assoc()) {
            return $row['prop_name'];
        } else {
            return "Unknown hotel";
        }
    }
}

?>
