<?php
require_once 'server.php';

class UserAuthentication
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function loginUser($fName, $lName, $Password)
    {
        $errors = array();

        if (empty($fName)) {
            $errors[] = "First Name is required";
        }
        if (empty($lName)) {
            $errors[] = "Last Name is required";
        }
        if (empty($Password)) {
            $errors[] = "Password is required";
        }

        if (empty($errors)) {
            $user_check_query = "SELECT * FROM staff WHERE fName='$fName' AND lName='$lName' LIMIT 1";
            $result = mysqli_query($this->conn, $user_check_query);

            if (!$result) {
                $errors[] = "Query error: " . mysqli_error($this->conn);
            } else {
                $user = mysqli_fetch_assoc($result);

                if ($user) {
                    if ($Password == $user['Password']) {
                        $this->saveLoginToUpdateTable($fName, $lName);
                    
                        $_SESSION['ID'] = $user['ID'];
                        header("Location: home-staff.php");
                        exit();
                    }
                     else {
                        $errors[] = "Wrong password";
                    }
                } else {
                    $errors[] = "User not found";
                }
            }
        }

        return $errors;
    }

    private function saveLoginToUpdateTable($fName, $lName)
    {
        $insertQuery = "INSERT INTO user_update (fName, lName) VALUES ('$fName', '$lName')";
        mysqli_query($this->conn, $insertQuery);
    }
}
$userAuthentication = new UserAuthentication($conn);

if (isset($_POST['login_user'])) {
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $password = $_POST['password'];

    $loginErrors = $userAuthentication->loginUser($fName, $lName, $password);

    foreach ($loginErrors as $error) {
        echo $error . "<br>";
    }
}
?>
