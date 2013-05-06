<?php foreach ($songs as $row) { ?>
	<article id="<?php echo $row->song_id ?>" class="song row" data-song-slug="<?php echo $row->song_slug ?>" data-song-yt-id="<?php echo $row->song_yt_id ?>" data-song-favorites="<?php echo $row->song_favorites ?>">
		<div class="large-12 columns">
			<section class="content">
				<section class="thumbnail">
					<div class="flex-image">
						<img src="http://img.youtube.com/vi/<?php echo $row->song_yt_id ?>/hqdefault.jpg">
					</div>
				</section>
				<footer class="caption">
					<h2><a href="<?php echo base_url(); ?>song/<?php echo $row->song_slug ?>"><?php echo $row->song_title ?></a></h2>
					<p class="date"><span class="iconic clock"></span><?php echo date('F j Y', strtotime($row->song_uploaded)); ?></p>
					<p class="source"><span class="iconic home"></span><a href="<?php echo base_url(); ?>index.php/channel/<?php echo $row->song_channel_slug ?>"><?php echo $row->song_channel_name ?></a></p>
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
					<span class="favorite-count"><?php echo $row->song_favorites ?></span>
					<span class="iconic star"></span>
				</button>
				<?php } else { ?>
				<button class="favorite-song">
					<span class="favorite-count"><?php echo ++$row->song_favorites ?></span>
					<span class="iconic star"></span>
				</button>
			<?php } } else { ?>
				<button class="favorite-song">
					<span class="favorite-count"><?php echo ++$row->song_favorites ?></span>
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