<?php

session_start();
if($_SERVER["REQUEST_METHOD"]=="POST") {
  $login_username = $_POST["username"];
  $login_password = $_POST["password"];
  $_SESSION["username"] = $login_username;
  $_SESSION["password"] = $login_password;
  if(isset($_GET["q"])) {

    $p = $_GET["q"];
    header('location:questionlink.php?q='.$p);
  }
  else {
    $p = 1;
    header('location:questionlink.php?q='.$p);
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
</head>
<body>
  <h2>Login</h2>
  <?php echo $message?>
  <form method="post" action=''>
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <a href="./index2.php">Don't have an account?</a>
    <input type="submit" value="Login">
  </form>
</body>
</html>

