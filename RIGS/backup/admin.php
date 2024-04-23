<?php
require_once 'server1.php';
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
        table{
            display:flex;
            font-family:'Poppins', sans-serif;
            font-size:25px;
            align-items:center;
            justify-content:center;
        }
        button{
            position:absolute;
            right:300px;
            top:150px;
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
        tr{
            display:flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: space-between;
  align-items: normal;
  align-content: normal;
        }
       
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-admin">
        <button onclick="window.location.href='login.html';">
        Logout
    </button>
    <h2>User List</h2>
<a href="create.php" style="position:absolute;right:320px;text-decoration:none;">Create New Staff</a> <!-- Added link -->
<table>
    <tr>
        <th>ID</th>
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
            echo "<tr style='display:flex; flex-direction:row; flex-wrap:nowrap; justify-content:space-between; align-items:normal; align-content:normal;'>";
            echo "<td style='display:inline-block; width:100px'>" . $row["ID"] . "</td>";
            echo "<td style='display:inline-block; width:100px'>" . $row["Password"] . "</td>";
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
