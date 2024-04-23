<?php
session_start();
$servername = "172.16.0.214";
$username = "group35";
$password = "123456";
$dbname = "group35";
$errors = array();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}


$ID = "";
$password1 = "";


if (isset($_POST['ID'])) {
 $ID = mysqli_real_escape_string($conn, $_POST['ID']);
 $user_check_query = "SELECT * FROM admin WHERE ID='$ID'";
 $result = mysqli_query($conn, $user_check_query);
 $user = mysqli_fetch_assoc($result);
 
 }

if (count($errors) == 0) {
 $password = md5($password1);
 $query = "INSERT INTO admin (ID,password)
 VALUES ('$ID','$password')";

 mysqli_query($conn, $query);
 $_SESSION ['ID'] = $ID;
 $_SESSION ['success'] = "You are now logged in";

}

?>
