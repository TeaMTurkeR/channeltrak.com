<?php $i=0; foreach ($songs as $song) : ?>
	<article id="<?php echo $song->song_id ?>" class="song" data-song-slug="<?php echo $song->song_slug ?>" data-song-yt-id="<?php echo $song->song_yt_id ?>" data-song-favorites="<?php echo $song->song_favorites ?>">
		<section class="content">
			<section class="thumbnail">
				<div class="flex-media">
					<img src="http://img.youtube.com/vi/<?php echo $song->song_yt_id ?>/hqdefault.jpg">
					<?php if (isset($rank)) : ?>
					<div class="rank"><?php echo ++$i; ?></div>
					<?php endif; ?>
				</div>
			</section>
			<footer class="caption">
				<h2><a href="<?php echo base_url(); ?>index.php/song/<?php echo $song->song_slug ?>" title="<?php echo $song->song_title ?>"><?php echo $song->song_title ?></a></h2>
				<p class="date"><span class="icon-calendar-empty"></span><?php echo date('F j Y', strtotime($song->song_uploaded)); ?></p>
				<p class="source"><span class="icon-user"></span><a href="<?php echo base_url(); ?>index.php/channel/<?php echo $song->song_channel_slug ?>"><?php echo $song->song_channel_name ?></a></p>
			</footer>
		</section>
		<section class="actions">
		<?php 
			if ($this->session->userdata('logged_in')) :	
				$userId = $this->session->userdata('user_id');
				$songId = $song->song_id;
				$isFavorited = $this->User_model->checkFavorites($userId, $songId);
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
<?php endforeach; ?>