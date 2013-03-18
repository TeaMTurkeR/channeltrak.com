<?php
//review.php
	
	require_once 'includes/global.inc.php';

	$query = "SELECT * FROM channels";
	$result = mysql_query($query);
	while( $row = mysql_fetch_assoc( $result)){
	    $new_array[] = $row; // Inside while loop
	}

	$addChannelPost = new ChannelTools();

	if(isset($_POST['submit-approval'])) { 

		//retrieve the $_POST variables
		$id = $_POST['id'];
		$channelName = $_POST['channelName'];
		$channelId = $_POST['channelId'];
		$approved = '1';

		$addChannelPost->importPosts($channelId, $channelName);

		$data['id'] = $id;
		$data['channel_name'] = $channelName;
	    $data['channel_id'] = $channelId;
	    $data['approved'] = $approved;

		$updateChannel = new Channel($data);
		$updateChannel->save();

		header("Location: approve.php");
	}

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>

<?php include('includes/header.php'); ?>
	<form id="poster" action="approve.php" method="post" style="display: none;"></form>
	<div class="row">
		<div class="columns twelve">
			<h3>Channels Awaiting Approval</h3>
		</div>
	</div>
	<div class="row">
		<table class="twelve">
			<thead>
				<tr>
					<th>Name</th>
					<th>ID</th>
					<th>Submit Date</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

			<?php foreach ($new_array as $array){ if( $array['approved'] == 0 ): ?>

				<tr class="form">
					<td style="display: none;"><input value="<?php echo $array['id']; ?>" name="id" type="text" /></td>
					<td><input value="<?php echo $array['channel_name']; ?>" name="channelName" type="text"></td>
					<td><input value="<?php echo $array['channel_id']; ?>" name="channelId" type="text"></td>
					<td><?php echo $array['submit_date']; ?></td>
					<td>
						<button class="button radius small" onclick="window.open(<?php echo $array['channel_id'] ?>)">Review</button>
						<input type="submit" class="button radius small success" value="Approve" name="submit-approval" onclick="submitForm(this);"/>
						<a href="" class="button radius alert small">Delete</a>
					</td>
				</tr>

			<?php endif; } ?>

			</tbody>
		</table>	
	</div>
	<div class="row">
		<div class="columns twelve">
			<h3>Approved Channels</h3>
		</div>
	</div>
	<div class="row">
		<table class="twelve">
			<thead>
				<tr>
					<th>Name</th>
					<th>ID</th>
					<th>Submit Date</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

			<?php foreach ($new_array as $array){ if( $array['approved'] == 1 ): ?>

				<tr class="form">
					<td><input value="<?php echo $array['channel_name']; ?>" name="channelName" type="text" /></td>
					<td><input value="<?php echo $array['channel_id']; ?>" name="channelId" type="text" /></td>
					<td><?php echo $array['submit_date']; ?></td>
					<td>
						<a href="" class="button radius alert small">Delete</a>
					</td>
				</tr>

			<?php endif; } ?>

			</tbody>
		</table>	
	</div>

<?php include('includes/footer.php'); ?>