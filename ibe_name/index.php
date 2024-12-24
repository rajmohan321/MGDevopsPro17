<?php
// Include the Database class file

include_once 'Models/__api_data.php';



// Get raw POST data
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['product_code']) || !isset($data['customer_code'])) {
    echo json_encode(["message" => "Missing required fields in the request"]);
    return;
}
else {
    // Extract values from JSON
    $product_code = $data['product_code'];
    $customer_code = $data['customer_code'];
    formLoad($customer_code,$product_code);
}
