<?php
class Transaction {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function insertTransaction($user_id, $engine_status, $filtration_status, $ph_level, $reason) {
        $date = date('Y-m-d');

        // Prepare the SQL statement
        $stmt = $this->conn->prepare("INSERT INTO transaction (user_id, date, engine_status, filtration_status, ph_level, reason) VALUES (?, ?, ?, ?, ?, ?)");

        // Bind parameters to the prepared statement
        $stmt->bind_param("ssssss", $user_id, $date, $engine_status, $filtration_status, $ph_level, $reason);

        // Execute the prepared statement
        if ($stmt->execute()) {
            return true; // Successful insertion
        } else {
            return false; // Error occurred
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
