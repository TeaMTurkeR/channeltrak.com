<?php
	require_once 'includes/global.inc.php';

	$error = "";
	$username = "";
	$password = "";

	//check to see if they've submitted the login form
	if(isset($_POST['submit-login'])) { 

		$username = $_POST['username'];
		$password = $_POST['password'];

		$userTools = new UserTools();
		if($userTools->login($username, $password)){
			//successful login, redirect them to a page
			header("Location: index.php");
		}else{
			$error = "<b>Crap!</b> That's an incorrect username and/or password";
		}
	}
?>

<?php include('includes/header.php'); ?>

	<section class="row">
		<div class="columns four">
		
			<?php if($error != ""){ ?>
				<div class="alert alert-error">
					<?php echo $error; ?>
				</div>
			<?php } ?>

			<form class="user-form" action="login.php" method="post">
				<label for="username">Username</label>
				<input type="text" name="username" value="<?php echo $username; ?>" /><br/>
				<label for="password">Password</label>
				<input type="password" name="password" value="<?php echo $password; ?>" /><br/>
				<input class="button radius" type="submit" value="login" name="submit-login" />
			</form>

		</div>
	</section>

<?php include('includes/footer.php'); ?>