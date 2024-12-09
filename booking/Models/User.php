<?php

class User {
    protected $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    // Fetch user details by ID
    public function getUserById($userId) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
