
<?php
require_once 'server.php';

class Transaction {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayStatuses() {
        $sql = "SELECT u.fName, u.lName,u.ID,st.engine_status, st.filtration_status, st.ph_level, st.reason, st.date, st.ID
        FROM user_update u
        LEFT JOIN statuses st ON u.ID = st.ID
        ORDER BY u.ID DESC, st.ID DESC
        LIMIT 5";
        
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "First Name: " . $row["fName"] . "<br>";
                echo "Last Name: " . $row["lName"] . "<br>";
                echo "Engine Status: " . $row["engine_status"] . "<br>";
                echo "Filtration Status: " . $row["filtration_status"] . "<br>";
                echo "pH Level: " . $row["ph_level"] . "<br>";
                echo "Reason: " . $row["reason"] . "<br>";
                echo "Date: " . $row["date"] . "<br>";
                echo '<form method="post" action=""><input type="hidden" name="status_id" value="' . $row["ID"] . '"><input type="submit" name="delete" value="Delete"></form>';
                echo "<br>";    
            }
        } else {
            echo "0 results";
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
    public function deleteStatus($status_id) {
        $sql_statuses = "DELETE FROM statuses WHERE ID = $status_id";
        $result_statuses = $this->conn->query($sql_statuses);
    
        $sql_user_update = "DELETE FROM user_update WHERE ID = $status_id";
        $result_user_update = $this->conn->query($sql_user_update);
    
        if ($result_statuses && $result_user_update) {
            return true;
        } else {
            return false;
        }
    }
}
$transaction = new Transaction($conn);
if (isset($_POST['delete'])) {
    $status_id = $_POST['status_id'];
    if ($transaction->deleteStatus($status_id)) {
        echo "<script>alert('Transaction deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting transaction.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Statuses</title>
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
            position:absolute;
            right:15px;
            top:1px;
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

    <button onclick="window.location.href='admin.php';" >Go back</button>
        <button onclick="window.location.href='login.html';"style="position:absolute; top:50px;">Logout</button>
        <?php
        $transaction->displayStatuses();
        $transaction->closeConnection();
        ?>
    </div>
</body>
</html>

