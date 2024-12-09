<?php
include 'config.php';
class Database {
    protected $conn;
 
    public function __construct() {
        $this->conn = getDbConnection();
    }
    // Execute a query
    public function query($sql) {
        return $this->conn->query($sql);
    }

    // Prepare statement
    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }
}
?>
