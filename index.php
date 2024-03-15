<?php
session_start();

$_SESSION["username"] = "pramibhar";
$_SESSION["password"] = "4567";
if($_SERVER["REQUEST_METHOD"]=="POST") {
  $login_username = $_POST["username"];
  $login_password = $_POST["password"];
  if($_SESSION["username"] == $login_username && $_SESSION["password"] == $login_password) {
     $_SESSION["flag"] = 1;
    if(isset($_GET["q"])) {
      $p = $_GET["q"];
      header('location:questionlink.php?q=' . $p);
    }
    else {
      $p = 1;
      header('location:questionlink.php?q=' . $p);
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
</head>
<body>
  <div>
    <h2>Login</h2>
    <form method="post" action='<?php echo
        htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
      Username: <input type="text" name="username"><br><br>
      Password: <input type="password" name="password"><br><br>
      <a href="./index2.php">Don't have an account?</a>
      <input type="submit" value="Login">
    </form>
  </div>
</body>
</html>

