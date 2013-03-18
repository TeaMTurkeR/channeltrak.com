<?php
//index.php 

	require_once('includes/global.inc.php');

	$query = "SELECT * FROM posts ORDER BY upload_date DESC";
	$result = mysql_query($query);
	while( $row = mysql_fetch_assoc( $result)){
		$post_array[] = $row; // Inside while loop
	}

?>

<?php include('includes/header.php'); ?>

	<section id="main" class="row">

		<section id="nav" class="two columns">
			<ul>
				<li><a href="index.php">New</a></li>
				<li><a href="javascript:void(0)">Submit</a></li>
				<li><a href="javascript:void(0)">About</a></li>
			</ul>

		</section>

		<section id="tracklist" class="ten columns offset-by-two end">
		
			<?php foreach ($post_array as $array){ ?>

			<article class="track row">
				<div class="nine columns">
					<section id="<?php echo $array['video_id']; ?>" class="thumbnail">
						<div>
							<img width="480" height="360" data-original="http://img.youtube.com/vi/<?php echo $array['video_id']; ?>/hqdefault.jpg" src="img/placeholder.png" src="">
						</div>
					</section>
					<section class="info">
						<h5 class="ellipsis" title="<?php echo $array['video_title']; ?>"><?php echo $array['video_title']; ?></h5>
						<p><a href="http://www.youtube.com/user/<?php echo $array['channel_id']; ?>"><i class="icon-halfling-home"></i> <?php echo $array['channel_name']; ?></a></p>
						<p><i class="icon-halfling-time"></i> <?php echo date('F j', strtotime($array['upload_date'])); ?></p>
					</section>
				</div>
				<div class="three columns">
					<button class="action heart"><i class="icon-heart"></i></button><br>
					<button class="action share"><i class="icon-share"></i></button>
				</div>
			</article>

			<?php } ?>

		</section>	

	</section>	

<?php include('includes/footer.php'); ?>