<?php
class DatabaseConnection {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "users";
    protected $conn;
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}

class StaffUpdater extends DatabaseConnection {
    public function updateStaff($ID, $Password) {
        $sql = "UPDATE staff SET Password=? WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $Password, $ID);

        if ($stmt->execute()) {
            echo "Staff updated successfully";
        } else {
            echo "Error updating staff: " . $this->conn->error;
        }
    }
}
?>
