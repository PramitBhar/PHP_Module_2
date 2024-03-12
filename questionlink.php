<?php
session_start();
$query_value = isset($_GET['q']) ? $_GET['q'] : '';
$path_of_files = [
  '1' => 'Create a form with below fields:

    First Name - User will input only alphabets
    Last Name - User will input only alphabets
    Full name: User cannot enter a value in Full name field. It will be disabled
    by default. When the first name and last name fields are filled,
    this field outputs the sum of the above 2 fields.
    Submit Button
        On submit, the form gets submitted and the page will reload
        Hello [full-name]” will appear on the page',
  '2' => 'Add a new field to accept user image in addition to the above fields.
    On submit store the image in the backend and
    display it with the full name below it.',
  '3' => 'Add a text area to the above form and accept marks of different
  subjects in the format, English|80. One subject in each line. Once values
  entered and submitted, accept them to display the values in the
  form of a table.',
  '4' => 'Add a new text field to the above form to accept the phone number
  from the user. The number will belong to an Indian user.
  So, the number should begin with +91 and not be more than 10 digits.',
  '5' => 'Add a new single text field to the above form that will accept
  email id. Do not use email id input field type.
    Email Syntax check
        User will enter email id and on submit, check if correct email id
        syntax has been used.
        Show a message on successful email syntax or show an error message
        on the wrong syntax.
    b. Valid Email id check
        User will enter email id and on submit, use the following
        site http://www.mailboxlayer.com/ to check if the entered
        email id is valid.',
  '6' => 'When the user submits the above form, 2 copies of the data will get
  created in a doc format. One will store on the server and the other will be
  downloaded to the user submitting the data. The information in the doc
  should be presented in a well-defined manner.',
  '7' => 'Create a login form (using session). When logged in, implement pager
  with all above questions i.e one task per page. We should be able to identify
  each question by directly opening the page link but only after login.
  Ex: if i want the 4th question, i click on abc.com?q='
];

// Check if the query value exists in the file paths array.
if (array_key_exists($query_value, $path_of_files)) {
  // Include the appropriate PHP file based on the query value.
  $content = $path_of_files[$query_value];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Question <?php echo $query_value ?></title>
</head>
<body>
<h1>Questions <?php echo $query_value ?></h1>
<p><?php echo $content ?></p>
</body>
</html>

