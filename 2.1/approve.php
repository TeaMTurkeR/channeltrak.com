<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title id="html-title">channeltrak | track youtube music channels</title>
	<meta name="description" content="Channeltrak compiles the best music-oriented Youtube Channels. Like your favorite tracks and submit channels that consistently post good stuff.">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/app.css">

	<script type="text/javascript" src="//use.typekit.net/nuh3nan.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body>

<?php 
if (isset($_GET['p'])) {   

	$pass = $_GET['p'];

	if( $pass == '1' ){ //Password protect all the things!

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

?>

		<section id="player-controls" style="display:none;">
			<div class="row">
				<div class="eight last columns offset-by-two">
					<button id="prev"><i class="icon-halfling-step-backward"></i></button>
					<button id="play"><i class="icon-halfling-play"></i></button>
					<button id="next"><i class="icon-halfling-step-forward"></i></button>
					<span id="song-title"></span>
				</div>
			</div>
		</section>

		<header id="header" class="row">
			<div class="twelve columns">
				<h1 id="logo"><a href="/">ChannelTrak</a></h1>
				<p>Consilidating the best youtube channels in one place.</p>
			</div>
		</header>

		<form id="poster" action="approve.php?pass=gonzaga06" method="post" style="display: none;"></form>
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
					</tr>
				</thead>
				<tbody>

				<?php foreach ($new_array as $array){ if( $array['approved'] == 1 ): ?>

					<tr class="form">
						<td><input value="<?php echo $array['channel_name']; ?>" name="channelName" type="text" /></td>
						<td><input value="<?php echo $array['channel_id']; ?>" name="channelId" type="text" /></td>
						<td><?php echo $array['submit_date']; ?></td>
					</tr>

				<?php endif; } ?>

				</tbody>
			</table>	
		</div>

	<?php include('includes/footer.php'); ?>



<?php 

	} else { echo '<h1 style="font-size:300px;color:#eee;text-align:center;margin-top:100px;">Milagro!</h1>'; } 

} else { echo '<h1 style="font-size:300px;color:#eee;text-align:center;margin-top:100px;">Milagro!</h1>'; }

?>