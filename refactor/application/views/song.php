<?php $this->load->view('includes/header'); ?>

<section class="row">
	<section id="main" class="large-12 columns">
		<div id="loop">
			<?php foreach ($songs as $song) { ?>
				<article id="<?php echo $song->song_id ?>" class="song row" data-song-slug="<?php echo $song->song_slug ?>" data-song-yt-id="<?php echo $song->song_yt_id ?>" data-song-favorites="<?php echo $song->song_favorites ?>">
					<div class="large-12 columns">
						<section class="content">
							<section class="thumbnail">
								<div class="flex-video widescreen">
									<iframe src="http://www.youtube.com/embed/<?php echo $song->song_yt_id ?>?html5=1&autoplay=1"></iframe>
								</div>
							</section>
							<footer class="caption">
								<h2><a href="<?php echo base_url(); ?>index.php/song/<?php echo $song->song_slug ?>"><?php echo $song->song_title ?></a></h2>
								<p class="date"><span class="iconic clock"></span><?php echo date('F j Y', strtotime($song->song_uploaded)); ?></p>
								<p class="source"><span class="iconic home"></span><a href="<?php echo base_url(); ?>index.php/channel/<?php echo $song->song_channel_slug ?>"><?php echo $song->song_channel_name ?></a></p>
							</footer>
						</section>
						<section class="actions">
						<?php 

							if ($this->session->userdata('logged_in')) {	
								$userId = $this->session->userdata('user_id');
								$songId = $song->song_id;
								$isFavorited = $this->Favoritemodel->checkFavorites($userId, $songId);

								if($isFavorited) {
						?>
							<button class="favorite-song favorited">
								<span class="favorite-count"><?php echo $song->song_favorites ?></span>
								<span class="iconic star"></span>
							</button>
							<?php } else { ?>
							<button class="favorite-song">
								<span class="favorite-count"><?php echo ++$song->song_favorites ?></span>
								<span class="iconic star"></span>
							</button>
						<?php } } else { ?>
							<button class="favorite-song">
								<span class="favorite-count"><?php echo ++$song->song_favorites ?></span>
								<span class="iconic star"></span>
							</button>
						<?php } ?>
							<button class="share-song">
								<span class="iconic share"></span>
							</button>
						</section>
					</div>
				</article>
			<?php } ?>
		</div>
	</section>
</section>

<?php $this->load->view('includes/footer');?>

