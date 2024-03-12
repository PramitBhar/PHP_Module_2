<?php

require 'access_api.php';
class User {
  /**
   * This is a constuctor function.
   *
   * @param type:string
   *
   */
  public function __construct(string $email) {
    $this->email = $email;
  }
  /**
   * This function is used to validate email.
   *
   * @return type: array
  */
  function emailValidator() {
    $emailError = 0;
    $emailErrorMessage = '';
    $email = $_POST["email"];
    // Validate email format
    $email = strtolower($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailError = 1;
      $emailErrorMessage = "Invalid email address format!";
      return array('error' => $emailError, 'message' => $emailErrorMessage);
    }
    // Validate email using external API
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL =>
      'https://emailvalidation.abstractapi.com/v1/?api_key=' . $api_key . '&email=' . $email,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FOLLOWLOCATION => true
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);
   if ($data["is_disposable_email"]["value"] === true) {
        $emailError = 1;
        $validError = "Disposable Emails are not allowed!";
      }
      if ($data['deliverability'] === 'UNDELIVERABLE') {
        $emailError = 1;
        $validError = "Invalid email as it is Undeliverable!";
      }
      else {
        $validError = "email passed successfully.";
    }
  return array('error' => $emailError, 'message' => isset($validError) ? $validError : '');
  }
}
?>
