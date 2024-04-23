<?php
require_once 'server.php';

class userCreate
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createUser($Password, $fName, $lName, $role)
    {
        if (empty(trim($Password))) {
            $Password_err = "Please enter your Password.";
        }
        if (empty(trim($fName))) {
            $fName_err = "Please enter your First Name.";
        }
        if (empty(trim($lName))) {
            $lName_err = "Please enter your Last Name.";
        }
        if (empty(trim($role))) {
            $role_err = "Please enter the role of the staff.";
        }
        if (empty($Password_err) && empty($fName_err) && empty($lName_err) && empty($role_err)) {
            $sql = "INSERT INTO staff (Password, fName, lName, role) VALUES (?,?,?,?)";

            if ($stmt = $this->conn->prepare($sql)) {
                $stmt->bind_param("ssss", $Password, $fName, $lName, $role);
                if ($stmt->execute()) {
                    header("location: admin.php");
                    exit();
                } else {
                    echo "Something went wrong. Please try again later.";
                }

                $stmt->close();
            }
        }
    }
}

$userCreate = new userCreate($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Password = isset($_POST["Password"]) ? $_POST["Password"] : "";
    $fName = isset($_POST["FirstName"]) ? $_POST["FirstName"] : "";
    $lName = isset($_POST["LastName"]) ? $_POST["LastName"] : "";
    $role = isset($_POST["Role"]) ? $_POST["Role"] : "";

    $userCreate->createUser($Password, $fName, $lName, $role);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="container">
        <h2>Create User</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>First Name: </label>
                <input type="text" name="FirstName"
                    value="<?php echo isset($_POST['FirstName']) ? $_POST['FirstName'] : ''; ?>"
                    style="position:absolute;right:140px">
                <span>
                    <?php echo isset($fName_err) ? $fName_err : ''; ?>
                </span>
            </div>
            <div>
                <label>Last Name: </label>
                <input type="text" name="LastName"
                    value="<?php echo isset($_POST['LastName']) ? $_POST['LastName'] : ''; ?>"
                    style="position:absolute;right:140px">
                <span>
                    <?php echo isset($lName_err) ? $lName_err : ''; ?>
                </span>
            </div>
            <div>
                <label>Role: </label>
                <input type="text" name="Role" value="<?php echo isset($_POST['Role']) ? $_POST['Role'] : ''; ?>"
                    style="position:absolute;right:140px">
                <span>
                    <?php echo isset($role_err) ? $role_err : ''; ?>
                </span>
            </div>

            <div>
                <label>Password:</label>
                <input type="text" name="Password"
                    value="<?php echo isset($_POST['Password']) ? $_POST['Password'] : ''; ?>"
                    style="position:absolute;right:140px">
                <span>
                    <?php echo isset($Password_err) ? $Password_err : ''; ?>
                </span>
            </div>
            <div>
                <br>
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>

</html>