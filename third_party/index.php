
<?php
require_once '__libs/_database.php';  // Include database connection
require_once 'Controller/ApiController.php';
require_once('Models/User.php');

// Initialize controllers
$apiController = new ApiController();
$userController = new User();
 $data = json_decode(file_get_contents("php://input"),true);
if($data){
       $action = $data['action'];
 }


// Routing example
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        switch ($action) {
            case 'create_booking':
               $result = 1;
                echo $result;
                break;

            case 'get_inhouse_guestlist':
                
                header('Content-Type: application/json'); 
                 echo json_encode($apiController->viewsBookings(),JSON_PRETTY_PRINT);
                break;
        }
    }


?>
    

