<?php

session_start();

// Initialize $content variable
$content = '';

if (isset($_SESSION["flag"])) {
  $query_value = isset($_GET['q']) ? $_GET['q'] : '';
  $path_of_files = [
    '1' => '/PHP_Basic_Asg/assignment1/html/index.php',
    '2' => '/PHP_Basic_Asg/assignment2/html/index.php',
    '3' => '/PHP_Basic_Asg/assignment3/html/index.php',
    '4' => '/PHP_Basic_Asg/assignment4/html/index.php',
    '5' => '/PHP_Basic_Asg/assignment5/html/index.php',
    '6' => '/PHP_Basic_Asg/assignment6/html/index.php',
    '7' => '/PHP_Basic_Asg/assignment7/html/index.php',
  ];
  // Check if the query value exists in the file paths array.
  if (array_key_exists($query_value, $path_of_files)) {
    // Include the appropriate PHP file based on the query value.
    $content = require_once($path_of_files[$query_value]);
  }
} else {
  header('location:index.php');
  exit; // Ensure script stops executing after redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div>
    <?php echo $content; ?>
    <form method="post" action="logout.php">
      <input type="submit" value="Logout">
    </form>
  </div>
</body>
</html>
