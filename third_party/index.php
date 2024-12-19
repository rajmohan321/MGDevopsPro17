<?php
require_once '__libs/_database.php';  // Include database connection
require_once 'Controller/ApiController.php';
// require_once('Models/User.php');
require_once '__libs/_functions.php';
// Initialize controllers
$apiController = new ApiController();
$auth_usr = $_SERVER['PHP_AUTH_USER'];
$auth_pwd = $_SERVER['PHP_AUTH_PW'];
if (!isset($_GET['function_called']) || $_GET['function_called'] !== 'true') {
    Api::api_auth($auth_usr, $auth_pwd);  // Authenticate user
}








 $data = json_decode(file_get_contents("php://input"),true);
$action = $data['action'];


// Routing example
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

            if($action =="get_inhouse_guestlist"){

                $apiController->viewsBookings();
                
                 
            }else{
                    echo "Please send data format in json";
            }
        
    }else{
        echo "Please end the data in post method";
    }


?>
    

