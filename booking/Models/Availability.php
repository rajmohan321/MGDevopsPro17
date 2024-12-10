<?php
class Availability {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Check if an agent is available between the given start and end date
    public function checkAvailability($agentId, $startDate, $endDate) {
        $stmt = $this->db->prepare("SELECT * FROM availability WHERE agent_id = ? 
                                    AND available_from <= ? 
                                    AND available_to >= ?");
        $stmt->bind_param("iss", $agentId, $startDate, $endDate);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Check if a service is available with the agent for the specific dates
   
}
?>
