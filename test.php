<!-- <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mohan_newdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Simulate a POST request with the 'action' parameter
// $_SERVER['REQUEST_METHOD'] = "POST";
// $_POST['action'] = 'get_inhouse_guestlist';
// require_once 'third_party/__libs/_database.php';  // Include database connection
// require_once 'third_party/Controller/ApiController.php';
// include 'third_party/index.php';

// Check if the HTTP_AUTH_USER and HTTP_AUTH_PW are provided
// if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
//     // If not, send a 401 Unauthorized response with a WWW-Authenticate header
//     header('HTTP/1.1 401 Unauthorized');
//     header('WWW-Authenticate: Basic realm="Restricted Area"');
//     echo 'You need to enter a valid username and password to access this page.';
//     exit; // Stop the script
// }

// // Assuming we have a predefined username and password (e.g., admin/admin)


// // Check if the provided username and password are correct
// if ($_SERVER['PHP_AUTH_USER'] == $valid_user && $_SERVER['PHP_AUTH_PW'] == $valid_password) {
//     echo 'Welcome, ' . htmlspecialchars($_SERVER['PHP_AUTH_USER']) . '!';
// } else {
//     // If the credentials don't match, show an error message
//     header('HTTP/1.1 401 Unauthorized');
//     echo 'Invalid username or password!';
//     exit;
// }


$customer_code = "CUST001";
$sql = "SELECT max_room,max_adults,product_code FROM ibe_initial_settings WHERE customer_code = ?";
if ($stmt = $conn->prepare($sql)) {
    // Bind the parameters to the placeholders in the SQL query
    $stmt->bind_param("s", $customer_code);  // "ss" means both are strings

    // Execute the query
    $stmt->execute();

    // Get the result of the query
    $result = $stmt->get_result();

// Initialize an empty array to store data
$data = array();

// Check if rows are returned
if ($result->num_rows > 0) {
    // Fetch rows and add them to the array
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'max_adult' => $row['max_adults'],
            'max_room' => $row['max_room'],
            'product_code'=>$row['product_code']
        );
    }
}
}
var_dump($data);


?>

 -->
