<?php

  /*
    * This class is used to validate user input.
    *
    * @param type: string
    *
    * return type: object
  */
  class User {
    // This variable indicates the first name of the user.
    public string $fname;
    // This variable indicates the last name of the user.
    public string $lname;
    /*
      * This constuctor class initialize the fname and lname variable.
      *
      * @param type: string
    */
    public function __construct(string $fname, string $lname) {
      $this->fname = $fname;
      $this->lname = $lname;
    }
    /*
      * This function is used to validate user input using regex
      *
      * @param type: no parameter is passed
      *
      * return type: string
    */
    public function validate_user_input() {
      // This pattern is used to check given input is valid or not.
      $pattern = "/^[A-Za-z]+$/";
      // Below condition is used to check if both the input field is correct.
      if (preg_match($pattern, $this->fname) &&
      preg_match($pattern, $this->lname)) {
        $fullname = $this->fname . " " . $this->lname;
        return $fullname;
      }
      if(
        !preg_match($pattern, $this->fname) &&
        !preg_match($pattern, $this->lname)) {
          return "";
      }
      elseif (!preg_match($pattern, $this->fname)) {
        return $this->fname;
      }
      elseif (!preg_match($pattern, $this->lname)) {
        return $this->lname;
      }
    }
    /*
      * This function is used to validate image.
      *
      * @params type: no params is pass.
      *
      * return type: string
    */
    public function is_uploaded_image_validate() {
      if (isset($_FILES["image"])) {
        $uploaded_img_dir = "user_uploaded_image/";
        $target_file = $uploaded_img_dir .
        basename($_FILES["image"]["name"]);
      }
      return $target_file;
    }
  }
?>

