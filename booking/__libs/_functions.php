<?php  
// Validate theme_color
// $allowed_colors = ['black', 'white', 'grey'];
// if (!in_array($data['theme_color'], $allowed_colors)) {
//     echo json_encode(["message" => "Invalid theme_color. Allowed values are: black, white, grey."]);
//     exit();
// }
// function updateThemeColorIfNeeded() {
//     // Get a connection to the database
//     $conn = Database::getConnection();

//     // First, check if the provided theme_color matches the database
//     $checkThemeQuery = "SELECT theme_color FROM ibe_initial_settings WHERE from_date >= ? AND to_date <= ?";

//     // Prepare the check query
//     if ($stmt = $conn->prepare($checkThemeQuery)) {
//         // Bind the parameters (from_date and to_date)
//         $stmt->bind_param("ss", $from_Date, $to_Date);  // "ss" means both are strings

//         // Execute the query
//         $stmt->execute();
//         $result = $stmt->get_result();

//         // Initialize flag to check if update is needed
//         $updateNeeded = false;
//         $existingThemeColor = '';

//         // Check if records were returned and get the theme_color from the database
//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 // Assuming we just need to check the first row for simplicity
//                 $existingThemeColor = $row['theme_color'];
//                 if ($existingThemeColor !== $theme_Color) {
//                     $updateNeeded = true;
//                 }
//             }
//         }

//         // If the theme_color is different, update the records
//         if ($updateNeeded) {
//             // Prepare the update SQL query to alter the theme_color based on from_date and to_date
//             $updateQuery = "UPDATE ibe_initial_settings SET theme_color = ? WHERE from_date >= ? AND to_date <= ?";

//             if ($updateStmt = $conn->prepare($updateQuery)) {
//                 // Bind parameters for the update query
//                 $updateStmt->bind_param("sss", $theme_Color, $from_Date, $to_Date);

//                 // Execute the update query
//                 $updateStmt->execute();
//             }
//         }

//     }
// }

?>