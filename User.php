<?php

// This file is used to store api key.
require 'access_api.php';

  /**
    * This class is used to validate user input.
    *
    * @param type: string
    *
    * @return type: object
  */
class User {
  // This variable indicates the first name of the user.
  public string $fname;
  // This variable indicates the last name of the user.
  public string $lname;
  // This variable contain subject name and marks of the user.
  public string $subject_name_marks;
  // This variable is used to store the formatted table input.
  public string $table_input_format_creater = "";
  /**
    * This constuctor class initialize the fname and lname variable.
    *
    * @param type: string
  */
  public function __construct(string $fname, string $lname,
  string $subject_name_marks) {
    $this->fname = $fname;
    $this->lname = $lname;
    $this->subject_name_marks = $subject_name_marks;
  }
  /**
    * This function is used to validate user input using regex
    *
    * @param type: no parameter is passed
    *
    * @return type: string
  */
  public function validate_user_input()
  {
    // This pattern is used to check given input is valid or not.
    $pattern = "/^[A-Za-z]+$/";
    // Below condition is used to check if both the input field is correct.
    if (
      preg_match($pattern, $this->fname) &&
      preg_match($pattern, $this->lname)
    ) {
      $fullname = $this->fname . " " . $this->lname;
      return $fullname;
    }
    if (
      !preg_match($pattern, $this->fname) &&
      !preg_match($pattern, $this->lname)
    ) {
      return "";
    }
    elseif (!preg_match($pattern, $this->fname)) {
      return $this->fname;
    }
    elseif (!preg_match($pattern, $this->lname)) {
      return $this->lname;
    }
  }
  /**
    * This function is used to validate image.
    *
    * @param type: no params is pass.
    *
    * @return type: string
  */
  public function is_uploaded_image_validate()
  {
    if (isset($_FILES["image"])) {
      $uploaded_img_dir = "user_uploaded_image/";
      $target_file = $uploaded_img_dir .
        basename($_FILES["image"]["name"]);
    }
    return $target_file;
  }
  /**
    * This function is used to subject name and marks pattern.
    *
    * @param type: no params pass
    *
    * @return type: string
  */
  public function is_valid_subject_name_and_marks() {
    $pattern = "/^[ ]*[a-zA-z]+[|][0-9]{1,3}[ ]*$/";
    $name_marks_pair = explode("\n", $this->subject_name_marks);
    global $table_input_format_creater;
    $table_input_format_creater .= "<tr>";
    $table_input_format_creater .= "<th> Subject Name </th>";
    $table_input_format_creater .= "<th> Marks </th>";
    $table_input_format_creater .= "</tr>";
    foreach($name_marks_pair as $pair) {
      $pair = trim($pair);
      if(!empty($pair) && preg_match($pattern,$pair)) {
        $table_input_format_creater .= $this->createTableFomatter($pair);
      }
      elseif(empty($pair)) {
        continue;
      }
      else {
        return "FALSE";
      }
    }
    return $table_input_format_creater;
  }
  /**
    * This function is used to print the input of the table in a mentioned
    * format.
    *
    * @param type: string
    *
    * @return type: string
  */
  public function createTableFomatter(string $pair) {
    $format_maker="";
    $keyvalue = explode("|", $pair);
    $key = trim($keyvalue[0]);
    $value = trim($keyvalue[1]);
    $format_maker .= "<tr>";
    $format_maker .= "<td>$key</td>";
    $format_maker .= "<td>$value</td>";
    $format_maker .= "</tr>";
    return $format_maker;
  }
  /**
   * This function is used to validate email id using Abstract api.
   *
   * @return array
   */

  public function emailValidator() {
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
      CURLOPT_URL => 'https://emailvalidation.abstractapi.com/v1/?api_key=' . $api_key . '&email=' . $email,
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
    return array('error' => $emailError, 'message' =>
    isset($validError) ? $validError : '');
  }
}
?>
