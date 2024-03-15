<?php

session_start();
/**
  * This class is used to validate user.
  *
  * @param string
  *
  * @return type: object
*/
class User {
  // This variable contains username of the user.
  public string $username;
  // This variable contains password of the user.
  public string $password;
  /**
    * This constructor function initialize username and password variable.
    *
    * @param string
  */
  public function __construct(string $username, string $password) {
    $this->username = $username;
    $this->password = $password;
  }
  /**
    * This function is used to verify user credentials.
    *
    * @param: no params passed
    *
    * @return type: boolean
  */
  public function verifyUserCredentials() {
    $file = fopen("user_credentials.txt","r");
    if($file) {
      $every_line = explode("\n", fgets($file));
      // $line = fgets($file);
      // echo $every_line;
      if(!empty($line)) {
        // echo fgets($file);
        foreach ($every_line as $p) {
          $credentials = explode(":",trim($p));
          $stored_username = $credentials[0];
          $stored_password = $credentials[1];
          echo $stored_username;
        }
        if($this->username == $stored_username && $this->password ==
        $stored_password) {
          fclose($file);
          return TRUE;
        }
      }
    }
    return FALSE;
  }
  /**
   * This function is used to store new user login details in database.
   *
   * @param: nothing is passed
   *
   * @return bool
  */
  public function storeUserRegistrationDetails() {
    $file = fopen("user_credentials.txt", "a");
    if ($file) {
      fwrite($file, "hello:prami");
      fclose($file);
      return TRUE;
    }
    return FALSE;
  }
}

?>
