<?php

class Booking {
    protected $db;
  
    public function __construct() {
        $this->db = new Database();
    }
     public  function get_guest_bill(){
       
        $stmt = $this->db->prepare("SELECT * FROM guest_register");
        $stmt->execute();
        $result = $stmt->get_result();

        $data = array();

        // Fetch all rows from the result
        while ($row = $result->fetch_assoc()) {
            $hotelname = isset($row['HotelName']) ? $row['HotelName'] : ''; // Default value
            $pass_word = isset($row['password'])?$row['password']:'';
            $data[] = [
                'HotelName'=> $hotelname,
                'RoomNo'=>$row['room_no'],
                'Password'=>$pass_word,
                'guest_name'=>$row['guest_name'],
                'phone'=>$row['phone']
            ]; // Add each row to the data array
        }
        echo "RoomData:".json_encode($data,JSON_PRETTY_PRINT);
        
     }
}
?>
