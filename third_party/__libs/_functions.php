<?php 

class Api{
public static function api_auth($auth_user,$auth_pswd){
if (!isset($auth_user) || !isset($auth_pswd)) {
    // If not, send a 401 Unauthorized response with a WWW-Authenticate header
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    echo 'You need to enter a valid username and password to access this page.';
    exit; // Stop the script
}

// Assuming we have a predefined username and password (e.g., admin/admin)

$valid_user = "Admin";
$valid_password = "admin";
// Check if the provided username and password are correct
if ($auth_user == $valid_user && $auth_pswd == $valid_password) {
             
} else {

    // If the credentials don't match, show an error message
    header('HTTP/1.1 401 Unauthorized');
    echo 'Invalid username or password!';
    exit;
}
}

}

?>