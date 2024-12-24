<?php


include '__libs/Database.class.php';



  $conn = Database::getConnection();
function formLoad($customer_Code, $product_Code)
{
    $conn = Database::getConnection();
    $sql = "SELECT  max_room, max_adults, max_occupancy, theme_color_white, from_date, to_date FROM ibe_initial_settings WHERE customer_code = ? and product_code = ? ";
    if ($stmt = $conn->prepare($sql)) {

        // Bind the parameters to the placeholders in the SQL query
        $stmt->bind_param("ss", $customer_Code, $product_Code);  // "ss" means both are strings

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
                'max_room' => $row['max_room'],
                'max_adult' => $row['max_adults'],
                'max_occupancy' => $row['max_occupancy'],
                'theme_color' =>$row['theme_color_white'],
                'from_date'=>$row['from_date'],
                'to_date'=>$row['to_date']
            );
        }

        // Convert data to JSON format
        echo json_encode($data);
    } else {
        echo json_encode(["message" => "No data found"]);
    }
  } else {
    // If the SQL statement preparation failed, return an error message
    echo json_encode(["message" => "Failed to prepare SQL statement"]);
}   


}
?>