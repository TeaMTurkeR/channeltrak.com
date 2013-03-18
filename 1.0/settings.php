<?php 

require_once 'includes/global.inc.php';

//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
	header("Location: login.php");
}

//get the user object from the session
$user = unserialize($_SESSION['user']);

//initialize php variables used in the form
$email = $user->email;

//check to see that the form has been submitted
if(isset($_POST['submit-settings'])) { 

	//retrieve the $_POST variables
	$email = $_POST['email'];

	$user->email = $email;
	$user->save();

	header("Location: index.php");
}

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>

<?php include('includes/header.php'); ?>

	<section class="row">
		<div class="columns four">

			<form action="settings.php" method="post">
				<label for="email">Edit Email</label>
				<input type="text" value="<?php echo $email; ?>" name="email" /><br/>
				<input type="submit" value="save settings" class="button radius" name="submit-settings" />
			</form>

		</div>
	</section>

<?php include('includes/footer.php'); ?>