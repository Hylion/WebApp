<?php
require_once 'server.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
         body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; 
            background: #0047ab;
            margin: 0; 
            padding: 0; 
            font-family: 'Poppins', sans-serif;
        }

        .container-admin {
            background: #bebebe;
            width: 80%;
            height: 80%;
            box-shadow: 10px 10px 24px 1px rgba(255,255,255,0.75);
            -webkit-box-shadow: 10px 10px 24px 1px rgba(255,255,255,0.75);
            -moz-box-shadow: 10px 10px 24px 1px rgba(255,255,255,0.75);
        }
        h2{
            display:flex;
            font-family:'Poppins', sans-serif;
            font-size:40px;
            align-items:center;
            justify-content:center;
        } 
        button{
            
            border: 0;
  text-align: center;
  display: inline-block;
  padding: 14px;
  width: 150px;
  margin: 7px;
  color: #ffffff;
  background-color: #36a2eb;
  border-radius: 8px;
  font-family: "proxima-nova-soft", sans-serif;
  font-weight: 600;
  text-decoration: none;
  transition: box-shadow 200ms ease-out;
        }
        table{
             display:flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: space-around;
  align-items: center;
  align-content: normal; 

        }
        th{
            /* display:inline-block; */
            /* width:200px; */
            padding:20px;
        }
        td{
            /* display:inline-block; */
            /* width:200px; */
            padding:20px;
        }
        *{
            margin:0px;
            padding:0%;
        }
       
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-admin">
        <button onclick="window.location.href='login.html';"style="position:absolute;top:120px;right:240px">
        Logout
    </button>
    <h2>User List</h2>
    <br>
    <br>
    <button onclick="window.location.href='home-admin.php';" style="position:absolute;top:120px;left:220px;">
        Go to Home
    </button>                          
    <button onclick="window.location.href='create.php';" style="position:absolute;top:170px;right:240px">
        Create New Staff
    </button>
    <button onclick="window.location.href='transaction.php';" style="position:absolute;top:220px;right:240px">
        Check Engine Records
    </button>
<table>
    <tr>
        <th>FName</th>
        <th>LName</th>
        <th>Role</th>
        <th>Password</th>
        <th>Action</th>
    </tr>
    <?php
    
    $sql = "SELECT * FROM staff";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error: Unable to execute the query.";
    } elseif ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td >" . $row["fName"] . "</td>";
            echo "<td >" . $row["lName"] . "</td>";
            echo "<td >" . $row["role"] . "</td>";
            echo "<td >" . $row["Password"] . "</td>";
            echo "<td><a href='delete.php?ID=" . $row["ID"] . "'>Delete</a> | <a href='update.php?ID=" . $row["ID"] . "'>Update</a></td>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }

    
    $result->close();
    ?>
</table>
    </div>
    
</body>
</html>
