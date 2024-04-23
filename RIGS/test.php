<?php
class Transaction {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getCurrentStatus() {
        $sql = "SELECT s.engine_status, s.filtration_status, s.ph_level, st.ID as user_id
                FROM statuses s
                INNER JOIN staff st ON s.user_id = st.ID";
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            // Fetch data
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }
    

    public function closeConnection() {
        $this->conn->close();
    }
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

// Create a new Transaction object
$transaction = new Transaction($servername, $username, $password, $database);

// Fetch current status
$currentStatus = $transaction->getCurrentStatus();

// Close database connection
$transaction->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current System Status</title>
    <!-- Add your CSS stylesheets or include them here -->
</head>
<body>
    <h2>Current System Status</h2>
    
    <h3>ID: <?php echo $currentStatus['user_id']; ?></h3>
    <h3>Engine Status</h3>
    <p>Engine Status: <?php echo $currentStatus['engine_status']; ?></p>

    <h3>Filtration Status</h3>
    <p>Filtration Status: <?php echo $currentStatus['filtration_status']; ?></p>

    <h3>pH Sensor Level</h3>
    <p>pH Level: <?php echo $currentStatus['ph_level']; ?></p>
</body>
</html>
