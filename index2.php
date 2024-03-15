<?php
session_start();
include 'User.php';

if($_SERVER["REQUEST_METHOD"]=="POST") {
  $registered_username = $_POST["username"];
  $registered_password = $_POST["password"];
  $user = new User($username,$password);
  $success_message = $user->storeUserRegistrationDetails();
  echo $success_message;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
</head>

<body>
  <h2>Register</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);
  ?>">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <input type="submit" name="register" value="Register">
  </form>

</body>

</html>
