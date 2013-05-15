<?php $this->load->view('includes/header'); ?>

<section class="row">
	<aside id="side" class="large-3 columns">
		<?php $this->load->view('includes/side'); ?>
	</aside>
	<section id="main" class="large-9 columns">
		<?php foreach ($channels as $channel) { ?>

		<div class="channel large-6 columns">
			<div class="thumbnail">
				<div class="flex-image">
					<img src="http://img.youtube.com/vi/<?php echo $this->Song_model->getChannelImage($channel->channel_slug) ?>/hqdefault.jpg" alt="<?php echo $channel->channel_name ?>">
				</div>
			</div>
			<div class="caption">
				<h2><a href="<?php echo base_url(); ?>index.php/channel/<?php echo $channel->channel_slug ?>"><?php echo $channel->channel_name ?></a></h2>
				<p class="source"><span class="iconic link"></span><a href="http://www.youtube.com/user/<?php echo $channel->channel_yt_id ?>">Youtube</a></p>
			</div>
		</div>

		<?php } ?>
	</section>
</section>

<?php $this->load->view('includes/footer');?>