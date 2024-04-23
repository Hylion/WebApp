<?php
session_start();

// Database configuration
$servername = "172.16.0.214";
$username = "group35";
$password = "123456";
$dbname = "group35";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  ?>  
