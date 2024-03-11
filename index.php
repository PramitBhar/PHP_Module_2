<?php

include 'User.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = trim($_POST["fname"], " ");
  $lname = trim($_POST["lname"], " ");
  $fullname = $_POST["fullname"];
  $warning_message = "*Try to fill this field with Alphabet";
  $subject_name_marks = $_POST["subject_name_and_marks_input"];
  $phone_number = $_POST["phonenumber"];
  // New obj created.
  $user = new User($fname, $lname, $subject_name_marks);
  // This condition is used if someone explicitely try to change disabled field.
  if (!empty(htmlspecialchars($fullname))) {
    $error_message = "You can't explicitly change the disabled field.";
  } else {
    $form_validation = $user->validate_user_input();
    $warning_message = "*Try to fill this field with Alphabet";
    if (
      $form_validation != $fname && $form_validation != $lname &&
      !empty($form_validation)
    ) {
      $fullname = $fname . " " . $lname;
      $message = "Hello, " . $fullname;
    }
    elseif (empty($form_validation)) {
      $first_input_error_message = $warning_message;
      $second_input_error_message = $warning_message;
    }
    elseif ($form_validation == $fname) {
      $first_input_error_message = $warning_message;
    }
    else {
      $second_input_error_message = $warning_message;
    }
    // This is used to validate user uploaded file is image or not.
    $image_validation = $user->is_uploaded_image_validate();
    //It contains the file type of image.
    $imageFileType =
      strtolower(pathinfo($image_validation, PATHINFO_EXTENSION));
    // If image file type not matched then it shows error message.
    if (
      $imageFileType != "jpg" && $imageFileType != "png" &&
      $imageFileType != "jpeg"
    ) {
      $error_message = "Image file type doesn't match.";
    }
    // Otherwise it stores the image in a folder.
    else {
      move_uploaded_file($_FILES["image"]["tmp_name"], $image_validation);
    }
    // This is used to validate user input format is correct or not.
    $subject_name_and_marks_validator =
      $user->is_valid_subject_name_and_marks();

    if ($subject_name_and_marks_validator == "FALSE") {
      $error_message = "Subject name and marks format is incorrect.";
    }
    $is_phone_number_valid = $user->isValidNumber($phone_number);

    if(!$is_phone_number_valid){
      $phone_number_error_message = "It is not a valid Indian number";
    }
  }
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <style>
    <?php include "index.css"; ?>
  </style>
</head>

<body>
  <!-- Container start. -->
  <div class="container">
    <div class="form-container">
      <!-- Form heading. -->
      <h1>Fill the User Details</h1>
      <div class="form-contents">
        <!-- Form input fields.-->
        <form method="post" action="<?php echo
         htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
         enctype="multipart/form-data">
          <span class="warning-message">
            <?php if ($error_message != "") echo $error_message; ?>
          </span>
          <!-- First name input field. -->
          <div class="form-fields">
            <label class="form-fields-heading">
              <span class="warning-message">*</span>First Name:</label>
            <input type="text" class="form-input-fields"
            placeholder="First Name" value="<?php echo $fname ?>" name="fname"
            maxlength="35" required pattern="^[A-Za-z]+$"
            title="Fill this fields with alphabets only">
            <p class="warning-message">
              <?php echo $first_input_error_message ?>
            </p>
          </div>
          <!-- Last name input field. -->
          <div class="form-fields">
            <label class="form-fields-heading"> <span class="warning-message">*
              </span>Last Name:</label>
            <input type="text" class="form-input-fields" placeholder="Last Name"
             value="<?php echo $lname ?>" name="lname" maxlength="35" required
             pattern="^[A-Za-z]+$" title="Fill this fields with alphabets only">
            <p class="warning-message">
              <?php echo $second_input_error_message ?>
            </p>
          </div>
          <!-- Upload Image input field. -->
          <div class="form-fields">
            <label class="form-fields-heading">
              <span class="warning-message">*</span>Upload your image:</label>
            <input type="file" class="form-input-fields" name="image"
            accept="image/x-png , image/jpeg , image/jpg" required>
          </div>
          <!-- Subject name and marks input field. -->
          <div class="form-fields">
            <label class="form-fields-heading">
              Enter subject name and marks:
            </label>
            <textarea class="form-text-area-input-fields" rows="4" cols="30"
            name="subject_name_and_marks_input"
            placeholder=
            "Please follow this format:Subject Name|Marks"></textarea>
          </div>
          <!-- Full name display field. -->
          <div class="form-fields">
            <span class="form-fields-heading"> Full Name:</span>
            <input type="text" class="form-input-fields" placeholder="Full Name"
             name="fullname" value="<?php if (empty($error_message))
             echo htmlspecialchars($fullname); ?>" disabled>
          </div>
          <div class="form-fields">
            <label class="form-fields-heading"> <span class="warning-message">*
              </span>Phone Number:</label>
            <input type="text" class="form-input-fields"
            placeholder="Enter our phone number"
            value="<?php echo $phone_number ?>" name="phonenumber"
            maxlength="13" required pattern="^[+][0-9]+$"
            title="Only Indian numbers will be accepted">
            <p class="warning-message">
              <?php echo $phone_number_error_message ?>
            </p>
          </div>
          <!-- Submit button. -->
          <input type="submit" class="form-submit-btn" name="submit"
          value="Submit">
        </form>
      </div>
      <!-- Output message after form submission. -->
      <span class="output-message">
        <?php echo $message ?>
      </span>
      <div>
        <img src="<?php echo $image_validation; ?>" alt="Uploaded Image">
      </div>
      <div class="subject_marks_table">
        <table class="output-message2">
          <?php echo $subject_name_and_marks_validator ?>
        </table>
      </div>
    </div>
  </div>
  <!-- Container end. -->
</body>

</html>
