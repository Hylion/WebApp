<?php
require_once 'server.php';

class Status {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getCurrentStatus() {
        $sql = "SELECT engine_status, filtration_status, ph_level 
                FROM statuses 
                ORDER BY ID DESC
                LIMIT 1";
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function addStatus($engineStatus, $filtrationStatus, $phLevel, $reason, $date, $staffId) {
        $sql = "INSERT INTO statuses (engine_status, filtration_status, ph_level, reason, date, staff_id) VALUES ('$engineStatus', '$filtrationStatus', '$phLevel', '$reason', '$date', '$staffId')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    
    
    
    public function closeConnection() {
        $this->conn->close();
    }
}

$status = new Status($conn);
$currentStatus = $status->getCurrentStatus();
$currentEngineStatus = $currentStatus["engine_status"];
$currentFiltrationStatus = $currentStatus["filtration_status"];
$currentPHLevel = $currentStatus["ph_level"];


if (isset($_POST['submit'])) {
    $newEngineStatus = $_POST['engine_status'];
    $newFiltrationStatus = $_POST['filtration_status'];
    $newPHLevel = $_POST['ph_level'];
    $reason = $_POST['reason'];
    $date = $_POST['date'];
    $staffId = $_POST['staff_id']; 
    
    if ($status->addStatus($newEngineStatus, $newFiltrationStatus, $newPHLevel, $reason, $date, $staffId)) {
        header("location: home-staff.php");
    } else {
        echo "<script>alert('Error adding status: " . $status->conn->error . "');</script>";
    }
}



$status->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .status-on {
            color: green;
        }
        .status-maintenance {
            color: #FFCC00; 
        }
        .status-off {
            color: red;
        }
        button {
            
            border: 0;
            text-align: center;
            display: inline-block;
            padding: 8px;
            width: 100px;
            margin: 7px;
            color: #ffffff;
            background-color: #36a2eb;
            border-radius: 8px;
            font-family: "proxima-nova-soft", sans-serif;
            font-weight: 600;
            text-decoration: none;
            transition: box-shadow 200ms ease-out;
        } 
    </style>
</head>
<body>
    <div class="container" style="background-color:#bebebe">
        <button onclick="window.location.href='login.html';" style="position:absolute;right:15px;top:1px;">Logout</button>
        <button onclick="window.location.href='admin.php';" style="position:absolute;right:15px;top:40px;"> Go back </button>
        <h2>System Statuses</h2>
        <br>
        <form id="statusForm" method="post" action="home-staff.php">
        <label for="staff_id">Staff ID:</label>
            <input type="text" name="staff_id" id="staff_id" required>
            <br>
            <br>
        <h3>Engine Status</h3>
        <p>Engine Status: <span class="<?php echo getStatusColor($currentEngineStatus); ?>"><?php echo $currentEngineStatus; ?></span></p>
        
            <input type="radio" name="engine_status" value="On" <?php if($currentEngineStatus === "On") echo "checked"; ?>> On
            <input type="radio" name="engine_status" value="Under Maintenance" <?php if($currentEngineStatus === "Under Maintenance") echo "checked"; ?>> Under Maintenance
            <input type="radio" name="engine_status" value="Off" <?php if($currentEngineStatus === "Off") echo "checked"; ?>> Off
            <br>

            <h3>Filtration Status</h3>
            <p>Filtration Status: <span class="<?php echo getStatusColor($currentFiltrationStatus); ?>"><?php echo $currentFiltrationStatus; ?></span></p>
            <input type="radio" name="filtration_status" value="On" <?php if($currentFiltrationStatus === "On") echo "checked"; ?>> On
            <input type="radio" name="filtration_status" value="Under Maintenance" <?php if($currentFiltrationStatus === "Under Maintenance") echo "checked"; ?>> Under Maintenance
            <input type="radio" name="filtration_status" value="Off" <?php if($currentFiltrationStatus === "Off") echo "checked"; ?>> Off
            <br>

            <h3>pH Sensor Level</h3>
            <p>pH Level: <?php echo $currentPHLevel; ?></p>
            <select name="ph_level">
                <?php
                for ($i = 0; $i <= 14; $i++) {
                    echo "<option value='$i'";
                    if ($currentPHLevel == $i) echo " selected";
                    echo ">$i</option>";
                }
                ?>
            </select>
            <br>
            <h3>Reason</h3>
<input type="text" name="reason" required>

<h3>Date</h3>
<input type="date" name="date" required>
<br>

            <input type="submit" name="submit" value="Update Status" onclick="refreshPage()">
        </form>
    </div>
    <?php
    function getStatusColor($status) {
        switch ($status) {
            case 'On':
                return 'status-on';
            case 'Under Maintenance':
                return 'status-maintenance';
            case 'Off':
                return 'status-off';
            default:
                return '';
        }
    }
    ?>
    <script>
        function refreshPage() {
            setTimeout(function() {
                location.reload();
            }, 100);
        }
    </script>
</body>
</html>


