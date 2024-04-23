<?php require_once 'server.php' ?>
<!DOCTYPE html>

<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="styles.css">
 <style>
  button{
            
            border: 0;
  text-align: center;
  display: inline-block;
  padding: 14px;
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
 <div class="container">
    <div> 
    <button onclick="window.location.href='login.html';" style="position:absolute;transform:translate(1px, -130px);"> Go back </button>
    </div>
   <input type="checkbox" id="check">
   <div class="login form">
       <div class="logo">
           <img src="logo.png" alt="Logo">
         </div>
         <form action="login-admin.php" method="post">
     <input type="text" name="ID" placeholder="ADMIN ID">
     <input type="password" name="password" placeholder="PASSWORD">
     <input type="submit" name="login_user" class="button" value="Login">
   </form>
   </div>
   </div>
 </div>     
 
</body>
</html>
<script>
  const loginForm = document.getElementById('loginForm');
  const registrationForm = document.getElementById('registrationForm');
  const signupLabel = document.getElementById('signupLabel');
  const loginLabel = document.getElementById('loginLabel');
  const check = document.getElementById('check');

  signupLabel.addEventListener('click', () => {
    registrationForm.style.display = 'block';
    loginForm.style.display = 'none';
    check.checked = true;
  });

  loginLabel.addEventListener('click', () => {
    loginForm.style.display = 'block';
    registrationForm.style.display = 'none';
    check.checked = false;
  });
</script>