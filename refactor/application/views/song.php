<?php $this->load->view('includes/header'); ?>
<div id="page">
	<?php $this->load->view('includes/side'); ?>

	<section id="single">
		<article id="<?php echo $song->song_id ?>" class="song" data-song-slug="<?php echo $song->song_slug ?>" data-song-yt-id="<?php echo $song->song_yt_id ?>" data-song-favorites="<?php echo $song->song_favorites ?>">
			<section class="content">
				<section class="thumbnail">
					<div class="flex-media">
						<iframe src="http://www.youtube.com/embed/<?php echo $song->song_yt_id ?>?html5=1&autoplay=1"></iframe>
					</div>
				</section>
				<footer class="caption">
					<h2><a href="<?php echo base_url(); ?>song/<?php echo $song->song_slug ?>" title="<?php echo $song->song_title ?>"><?php echo $song->song_title ?></a></h2>
					<p class="date"><span class="icon-calendar-empty"></span><?php echo date('F j Y', strtotime($song->song_uploaded)); ?></p>
					<p class="source"><span class="icon-user"></span><a href="<?php echo base_url(); ?>channel/<?php echo $song->song_channel_slug ?>"><?php echo $song->song_channel_name ?></a></p>
				</footer>
			</section>
			<section class="actions">
			<?php 
				if ($this->session->userdata('logged_in')) :	
					$userId = $this->session->userdata('user_id');
					$songId = $song->song_id;
					$isFavorited = $this->Favorite_model->checkFavorites($userId, $songId);
			?>

				<?php if ($isFavorited) : ?>

				<button class="favorite-song favorited" title="Add to Favorites">
					<span class="favorite-count"><?php echo $song->song_favorites ?></span>
					<span class="icon-heart"></span>
				</button>

				<?php else : ?>

				<button class="favorite-song" title="Add to Favorites">
					<span class="favorite-count"><?php echo ++$song->song_favorites ?></span>
					<span class="icon-heart"></span>
				</button>

				<?php endif; ?>  

			<?php else : ?>
				<button class="favorite-song" title="Add to Favorites">
					<span class="favorite-count"><?php echo ++$song->song_favorites ?></span>
					<span class="icon-heart"></span>
				</button>
			<?php endif; ?>
				<button class="share-song" title="Post to Twitter">
					<span class="icon-twitter"></span>
				</button>
				<button class="share-song" title="Post to Facebook">
					<span class="icon-facebook"></span>
				</button>
				<button class="share-song" title="Permalink">
					<span class="icon-link"></span>
				</button>
			</section>
		</article>

<!-- 		<section id="related-songs">
			<h2>More from <?php echo $song->song_channel_name ?></h2>
			<div id="related-wrap">
				<article class="related-item">
					
				</article>
			</div>
		</section> -->
	</section>
</div>
<?php $this->load->view('includes/footer');?>

