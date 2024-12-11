<?php 
define('db_server', 'localhost');
define('db_username', 'root');
define('db_password', '');
define('db_database', 'mohan_newdb');


// Create connection to Database

function getDbConnection() {
    $conn = new mysqli(db_server, db_username, db_password, db_database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>