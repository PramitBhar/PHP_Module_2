<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
include 'User.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $email = $_POST["email"];
  $email = strtolower($email);
  $user = new USER($email);
  $email_checker = $user->emailValidator();
  if ($email_checker['error']) {
    $email_address_error_message = $email_checker['message'];
  }
  else {
    $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com;';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'rimobhar0426@gmail.com';
      $mail->Password   = 'rpelcfhpvhujticz';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port       = 465;
      $mail->setFrom('rimobhar0426@gmail.com');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'Welcome email'. $i;
      $mail->Body    = '<b>Thanks for submission.</b>';
      $mail->AltBody = 'Body in plain text for non-HTML mail clients';
      $mail->send();
      echo "Mail has been sent successfully!";
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    <?php include "index.css"; ?>
  </style>
</head>
<body>
  <div>
    <form method="post" action="<?php echo
      htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
      enctype="multipart/form-data">
      <input type="text" class="form-input-fields" placeholder="Enter your
        email address"
        value="<?php echo $email ?>" name="email" maxlength="35" required
        pattern="^[\w._]+@[\w]+(\.[a-z]{2,}){0,2}$"
        title="Fill this fields with valid email
        address only">
      <input type="submit" class="form-submit-btn" name="submit" value="Submit">
    </form>
  </div>
</body>
</html>

