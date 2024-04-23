<?php
require_once 'server.php';


class UserAuthentication
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function loginUser($ID, $password)
    {
        $errors = array();


        if (empty($ID)) {
            $errors[] = "ADMIN ID is required";
        }
        if (empty($password)) {
            $errors[] = "Password is required";
        }

        if (empty($errors)) {

            $user_check_query = "SELECT * FROM admin WHERE ID='$ID' LIMIT 1";
            $result = mysqli_query($this->conn, $user_check_query);

            if (!$result) {

                $errors[] = "Query error: " . mysqli_error($this->conn);
            } else {
                $user = mysqli_fetch_assoc($result);

                if ($user) {
                    if ($password == $user['Password']) {
                        $_SESSION['ID'] = $ID;
                        header("Location: admin.php");
                        exit();
                    } else {
                        $errors[] = "Wrong password";
                    }
                } else {
                    $errors[] = "ID not found";
                }
            }
        }

        return $errors;
    }
}
$userAuthentication = new UserAuthentication($conn);


if (isset($_POST['login_user'])) {
    $ID = mysqli_real_escape_string($conn, $_POST['ID']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    $loginErrors = $userAuthentication->loginUser($ID, $password);


    foreach ($loginErrors as $error) {
        echo $error . "<br>";
    }
}
#$ID = "";
#$password1 = "";

//if (isset($_POST['ID'])) {/
   // $ID = mysqli_real_escape_string($conn, $_POST['ID']);
   // $user_check_query = "SELECT * FROM admin WHERE ID='$ID'";
   // $result = mysqli_query($conn, $user_check_query);
   // $user = mysqli_fetch_assoc($result);
    
   // }
   
  // if (count($errors) == 0) {
   // $password = md5($password1);
   // $query = "INSERT INTO admin (ID,password)
    //VALUES ('$ID','$password')";
   
   // mysqli_query($conn, $query);
   // $_SESSION ['ID'] = $ID;
   // $_SESSION ['success'] = "You are now logged in";//
   
   //}
?>