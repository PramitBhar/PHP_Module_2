<?php

// This is the pattern which validate our form.
$pattern = "/^[A-Za-z]+$/";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$fname = trim($_POST["fname"], " ");
	$lname = trim($_POST["lname"], " ");
	$fullname = $_POST["fullname"];
	$warning_message = "*Try to fill this field with Alphabet";
	// This condition is used if someone explicitely try to change disabled field.
	if (!empty(htmlspecialchars($fullname))) {
		$message0 = "You can't explicitly change the disabled field.";
	} else {
		$fullname = $fname . " " . $lname;
		/* Below conditions are checking for if both the input field is Properly
		validate pattern or not,if first input field is properly validate and second
		input field is not or viceversa. */
		if (!preg_match($pattern, $fname) && !preg_match($pattern, $lname)) {
			$message1 = $warning_message;
		} elseif (!preg_match($pattern, $fname)) {
			$message2 = $warning_message;
		} elseif (!preg_match($pattern, $lname)) {
			$message3 = $warning_message;
		} else {
			$message = "Hello, " . $fullname;
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
				<form method="post" action="<?php echo
				htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

					<span class="warning-message">
						<?php if ($message0 != "") echo $message0; ?>
					</span>
					<!-- Form input fields.-->
					<!-- First name input field. -->
					<div class="form-fields">
						<label class="form-fields-heading">
							<span class="warning-message">*</span>First Name:</label>
						<input type="text" class="form-input-fields"
						 placeholder="First Name" value="<?php echo $fname ?>" name="fname"
						 maxlength="35">
						<p class="warning-message">
							<?php echo ($message1 != "") ? $message1 : $message2 ?>
						</p>
					</div>

					<!-- Last name input field. -->
					<div class="form-fields">
						<label class="form-fields-heading"> <span class="warning-message">*

						</span>Last Name:</label>
						<input type="text" class="form-input-fields" placeholder="Last Name"
						 value="<?php echo $lname ?>" name="lname" maxlength="35">
						<p class="warning-message">
							<?php echo ($message1 != "") ? $message1 : $message3 ?>
						</p>
					</div>
					<!-- Full name display field. -->
					<div class="form-fields">
						<span class="form-fields-heading"> Full Name:</span>
						<input type="text" class="form-input-fields" placeholder="Full Name"
						 name="fullname" value="<?php if ($message != "") echo
						 htmlspecialchars($fullname); ?>" disabled>
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
		</div>
	</div>
	<!-- Container end. -->
</body>

</html>
