<section id="info">
	<h2 id="page-title"><?php echo $title; ?></h2>

	<?php if (isset($subtitle)) : ?>

	<h3 id="page-subtitle"><?php echo $subtitle; ?></h3>

	<?php else : ?>

	<h3 id="page-subtitle">Joined <?php echo date('F j Y', strtotime($channel->channel_approved)); ?></h3>
	<ul class="page-info">
		<li><?php echo $channel->channel_tracks ?> Tracks</li>
		<li><?php echo $channel->channel_favorites ?> Favorites</li>
	</ul>
	<ul class="inline">

		<?php if ($channel->channel_yt_url != NULL) : ?>
			<li><a href="<?php echo $channel->channel_yt_url ?>"><span class="icon-play-sign"></span> Youtube</a></li>
		<?php endif; ?>

		<?php if ($channel->channel_tw_url != NULL) : ?>
			<li><a href="<?php echo $channel->channel_tw_url ?>"><span class="icon-twitter"></span> Twitter</a></li>
		<?php endif; ?>

		<?php if ($channel->channel_fb_url != NULL) : ?>
			<li><a href="<?php echo $channel->channel_fb_url ?>"><span class="icon-facebook"></span> Facebook</a></li>
		<?php endif; ?>

		<?php if ($channel->channel_web_url != NULL) : ?>
			<li><a href="<?php echo $channel->channel_web_url ?>"><span class="icon-external-link"></span> Website</a></li>
		<?php endif; ?>
		
	</ul>
	<?php endif; ?>
</section>
