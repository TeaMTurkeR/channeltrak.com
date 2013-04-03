<?php
//submitchannel.php

require_once 'includes/global.inc.php';

//initialize php variables used in the form
$name = "";
$url = "";
$error = "";


//check to see that the form has been submitted
if(isset($_POST['submit-form'])) { 

	//retrieve the $_POST variables
	$name = $_POST['name'];
	$url = $_POST['url'];

	//initialize variables for form validation
	$success = true;
	$channelTools = new ChannelTools();

	//validate that the form was filled out correctly
	//check to see if channel name already exists
	if($channelTools->checkChannelExists($name))
	{
			$error .= "That channel has already been submitted";
			$success = false;
	}

	if($success)
	{

		//prep the data for saving in a new channel object
		$data['channel_name'] = $name;
		$data['channel_id'] = $url;

		//create the new channel object
		$newChannel = new Channel($data);

		//save the new user to the database
		$newChannel->save(true);

		header("Location: index.php");

	}

}

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>

<?php include('includes/header.php'); ?>

	<section class="row">

		<?php include('includes/nav.php'); ?>

		<div class="columns six end offset-by-two">
		
			<?php if($error != ""){ ?>
				<div class="alert alert-error">
					<?php echo $error; ?>
				</div>
			<?php } ?>
			
			<form action="submit.php" method="post">
				<label for="name">Channel Name</label> 
				<input type="text" value="<?php echo $name; ?>" name="name" /><br/>
				<label for="url">Channel URL</label>
				<input type="text" value="<?php echo $url; ?>" name="url" /><br/>
				<input type="hidden" value="<?php echo $submitter; ?>" name="submitter" disabled=""/><br/>
				<input class="button radius" type="submit" value="submit channel for review" name="submit-form" />
			</form>

		</div>
	</section>

<?php include('includes/footer.php'); ?>