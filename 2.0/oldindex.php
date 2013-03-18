<?php
//index.php 

	require_once('includes/global.inc.php');

	$query = "SELECT * FROM posts ORDER BY upload_date DESC";
	$result = mysql_query($query);
	while( $row = mysql_fetch_assoc( $result)){
		$post_array[] = $row; // Inside while loop
	}

?>

<?php include('includes/header-fixed.php'); ?>
	
	<section id="intro">
		<div class="row">
			<div class="twelve columns">
				<h2>Channeltrak collects songs from the best music-oriented Youtube Channels. <a href="register.php">Join</a> and <a href="submit.php">submit</a> your own.</h2>
				<a href="javascript:void(0)" class="close">x</a>
			</div>
		</dvi>
	</section>

	<section id="track-list" role="main">

		<?php foreach ($post_array as $array){ ?>
				
		<article class="track" data-track-url="<?php echo $array['video_id']; ?>" data-track-id="<?php echo $array['id']; ?>">
			<div class="row">
				<section class="three columns track-thumbnail">
					<div class="aspect-ratio">
						<img class="yt-image" width="480" height="360" data-original="http://img.youtube.com/vi/<?php echo $array['video_id']; ?>/hqdefault.jpg" src="img/placeholder.png" src="">
					</div>
				</section>	
				<section class="seven columns track-content">
					<div class="info">
						<h2 class="ellipsis" title="<?php echo $array['video_title']; ?>"><?php echo $array['video_title']; ?></h2>
						<p><a href="http://www.youtube.com/user/<?php echo $array['channel_id']; ?>"><i class="icon-halfling-home"></i> <?php echo $array['channel_name']; ?></a></p>
						<p><i class="icon-halfling-time"></i> <?php echo date('F j', strtotime($array['upload_date'])); ?></p>
					</div>
					<div class="actions">
						<?php if(isset($_SESSION['logged_in'])) : ?>  

						<button data-track-upvotes="<?php echo $array['upvotes']; ?>" class="button radius small favorite">
							<i class="icon-halfling-heart icon-halfling-white"></i> 
							<span>Like</span>
						</button>			
	  						  
						<?php else : ?> 

						<button data-reveal-id="loginModal" class="button radius small not-logged-in"><i class="icon-halfling-heart icon-halfling-white"></i> Like</button>

						<?php endif; ?> 
						
						<button class="button radius small share"><i class="icon-halfling-share-alt icon-halfling-white"></i> Share</button>
					<div>
				</section>
			</div>
		</article>

		<?php } ?>

	</section>

	<aside id="track-player">
		<div class="row">
			<div class="columns twelve">
				<div id="player"></div>	
			</div>
		</div>
	</aside>


	<div id="loginModal" class="reveal-modal">
	  	<h2>Awesome. I have it.</h2>
	  	<p class="lead">Your couch.  It is mine.</p>
	  	<p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p>
	  	<a class="close-reveal-modal">&#215;</a>
	</div>

<?php include('includes/footer.php'); ?>

