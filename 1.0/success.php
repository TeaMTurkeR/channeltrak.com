<?php
//index.php 

	require_once('includes/global.inc.php');

	$query = "SELECT * FROM posts";
	$result = mysql_query($query);
	while( $row = mysql_fetch_assoc( $result)){
			$new_array[] = $row; // Inside while loop
	}

?>

<?php include('includes/header.php'); ?>

	<section class="row">
		<div class="columns four">
		
			<div class="alert-box success">
				<h3>Success!</h3>
			  	<p>Your submission will now be reviewed for addition to Channeltrak.</p>
			  	<a href="submit.php" class="button">Submit Another Channel</a>
				<a href="index.php" class="button">Home</a>
			  	<a href="" class="close">&times;</a>
			</div>

		</div>
	</section>

<?php include('includes/footer.php'); ?>
