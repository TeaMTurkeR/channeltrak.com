<?php
//index.php 

	require_once('includes/global.inc.php');

	$query = "SELECT * FROM posts ORDER BY upvotes DESC LIMIT 20";
	$result = mysql_query($query);
	while( $row = mysql_fetch_assoc( $result)){
		$post_array[] = $row; // Inside while loop
	}

?>

<?php include('includes/header.php'); ?>

	<section id="main" class="row">

		<?php include('includes/nav.php'); ?>

		<section id="tracklist" class="ten columns offset-by-two end">
		
			<?php foreach ($post_array as $array){ ?>

			<article id="<?php echo $array['id']; ?>"  class="track row">
				<div class="nine columns">
					<section id="<?php echo $array['video_id']; ?>" class="thumbnail">
						<div class="aspect-ratio">
							<img width="480" height="360" data-original="http://img.youtube.com/vi/<?php echo $array['video_id']; ?>/hqdefault.jpg" src="img/placeholder.png" src="">
						</div>
						<div class="rank"></div>
					</section>
					<section class="info">
						<h5 class="ellipsis" title="<?php echo $array['video_title']; ?>"><?php echo $array['video_title']; ?></h5>
						<p><a href="http://www.youtube.com/user/<?php echo $array['channel_id']; ?>"><i class="icon-halfling-home"></i> <?php echo $array['channel_name']; ?></a></p>
						<p><i class="icon-halfling-time"></i> <?php echo date('F j', strtotime($array['upload_date'])); ?></p>
					</section>
				</div>
				<div class="three columns">
					<button data-upvotes="<?php echo $array['upvotes']; ?>" class="action heart"><i class="icon-heart"></i></button><br>
					<button  href="http://twitter.com/share" class="action share twitter"><i class="icon-share"></i></button>
				</div>
			</article>

			<?php } ?>

		</section>	

	</section>	

<?php include('includes/footer.php'); ?>