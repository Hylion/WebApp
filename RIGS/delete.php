<?php
require_once 'server.php';

class StaffDeleter {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function deleteStaffByID($ID) {
        $sql = "DELETE FROM staff WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $ID);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}


$staffDeleter = new StaffDeleter($conn);

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    if ($staffDeleter->deleteStaffByID($ID)) {
        echo "<script>alert('Record Deleted Successfully');</script>";
        header('location:admin.php');
    } else {
        echo "Error deleting record";
    }
} else {
    echo "ID parameter is not set";
}

$conn->close();
exit();
?>
