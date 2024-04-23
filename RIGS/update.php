<?php
require_once 'server.php';

class StaffUpdater {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getStaffByID($ID) {
        $sql = "SELECT * FROM staff WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $ID); // "i" for integer type
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function updateStaff($fName, $lName, $role, $Password, $ID) {
        $sql = "UPDATE staff SET fName=?, lName=?, role=?,Password=? WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $fName, $lName, $role, $Password,$ID);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error updating staff: " . $stmt->error);
            return false;
        }
    }
}

$staffUpdater = new StaffUpdater($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fName = $_POST["newFName"];
    $lName = $_POST["newLName"];
    $role = $_POST["newRole"];
    $Password = $_POST["newPassword"];
    $ID = $_POST["ID"];

    if ($staffUpdater->updateStaff($fName, $lName, $role, $Password, $ID)) {
        echo "Staff updated successfully";
        header("Location: admin.php");
        exit(); 
    } else {
        echo "Error updating Staff. Please try again.";
    }
}

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    $conn_data = $staffUpdater->getStaffByID($ID);

    if (!$conn_data) {
        echo "Staff not found.";
        exit();
    }
} else {
    echo "Staff ID not provided.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Staff</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Update Staff</h2>
        <a href="admin.php"> Go back </a>
        <form method="POST" action="">
            <input type="hidden" name="ID" value="<?php echo htmlspecialchars($conn_data['ID']); ?>">
            <label>New First Name:</label>
            <input type="text" name="newFName" value="<?php echo htmlspecialchars($conn_data['fName']); ?>"><br>
            <label>New Last Name:</label>
            <input type="text" name="newLName" value="<?php echo htmlspecialchars($conn_data['lName']); ?>"><br>
            <label>New Role:</label>
            <input type="text" name="newRole" value="<?php echo htmlspecialchars($conn_data['role']); ?>"><br>
            <label>New Password: </label>
            <input type="text" name="newPassword" value="<?php echo htmlspecialchars($conn_data['Password']); ?>"><br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
