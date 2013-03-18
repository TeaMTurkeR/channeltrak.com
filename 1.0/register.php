<?php
//register.php

require_once 'includes/global.inc.php';

//initialize php variables used in the form
$username = "";
$password = "";
$password_confirm = "";
$email = "";
$error = "";

//check to see that the form has been submitted
if(isset($_POST['submit-form'])) { 

	//retrieve the $_POST variables
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password-confirm'];
	$email = $_POST['email'];

	//initialize variables for form validation
	$success = true;
	$userTools = new UserTools();

	//validate that the form was filled out correctly
	//check to see if user name already exists
	if($userTools->checkUsernameExists($username))
	{
		$error .= "That username is already taken.<br/> \n\r";
		$success = false;
	}

	//check to see if passwords match
	if($password != $password_confirm) {
		$error .= "Passwords do not match.<br/> \n\r";
		$success = false;
	}

	if($success)
	{
		//prep the data for saving in a new user object
		$data['username'] = $username;
		$data['password'] = md5($password); //encrypt the password for storage
		$data['email'] = $email;

		//create the new user object
		$newUser = new User($data);

		//save the new user to the database
		$newUser->save(true);

		//log them in
		$userTools->login($username, $password);

		//redirect them to a welcome page
		header("Location: index.php");

	}

}

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>

<?php include('includes/header.php'); ?>

	<section class="row">
		<div class="columns four">

			<form class="user-form" action="register.php" method="post">
				<label for="username">Username</label>
				<input type="text" name="username" value="<?php echo $username; ?>" />

				<label for="password">Password</label>
				<input type="password" name="password" value="<?php echo $password; ?>" />

				<label for="password-confirm">Confirm password</label>
				<input type="password" value="<?php echo $password_confirm; ?>" name="password-confirm" />

				<label for="email">Email</label>
				<input type="text" value="<?php echo $email; ?>" name="email" />

				<hr>
				<input class="button" type="submit" value="Register" name="submit-form" />
			</form>

		</div>
	</section>

<?php include('includes/footer.php'); ?>

