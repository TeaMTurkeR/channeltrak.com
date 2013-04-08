<?php 

	$data['title'] = 'Channeltrak';
	$this->load->view('includes/header', $data);

?>

<section class="row">
	<aside id="side" class="large-3 columns">
		<?php $this->load->view('includes/side'); ?>
	</aside>
	<section id="main" class="large-9 columns">
		<article id="<?php echo $row->song_id ?>" class="song row playing" data-song-yt-id="<?php echo $row->song_yt_id ?>" data-song-favorites="<?php echo $row->song_favorites ?>">
			<div class="large-12 columns">
				<section class="content">
					<section class="thumbnail">
						<div class="flex-video widescreen">
							<object width="425" height="350"><param name="movie" value="http://www.youtube.com/v/<?php echo $row->song_yt_id ?>&autoplay=1"></param><embed src="http://www.youtube.com/v/<?php echo $row->song_yt_id ?>&autoplay=1" type="application/x-shockwave-flash" width="425" height="350"></embed></object>
						</div>
					</section>
					<footer class="caption">
						<h2><?php echo $row->song_title ?></h2>
						<p class="date"><span class="iconic clock"></span><?php echo date('F j', strtotime($row->song_uploaded)); ?></p>
						<p class="source"><span class="iconic home"></span><a href=""><?php echo $row->song_channel_name ?></a></p>
					</footer>
				</section>
				<section class="actions">
				<?php 

					if ($this->session->userdata('logged_in')) {	
						$userId = $this->session->userdata('user_id');
						$songId = $row->song_id;
						$isFavorited = $this->Favoritemodel->checkFavorites($userId, $songId);

						if($isFavorited) {
				?>
					<button class="favorite-song favorited">
						<span class="iconic star"></span>
					</button>
				<?php } else { ?>
					<button class="favorite-song">
						<span class="iconic star"></span>
					</button>
				<?php } } else { ?>
					<button class="favorite-song">
						<span class="iconic star"></span>
					</button>
				<?php } ?>
					<button class="share-song">
						<span class="iconic share"></span>
					</button>
				</section>
			</div>
		</article>
	</section>
</section>

<?php $this->load->view('includes/footer');?>