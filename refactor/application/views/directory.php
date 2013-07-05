<?php $this->load->view('includes/header'); ?>
<div id="page">
	<?php $this->load->view('includes/side'); ?>
	
	<?php $this->load->view('includes/info'); ?>

	<section id="directory">
		<?php foreach ($channels as $channel) : ?>
		
		<a class="channel" href="<?php echo base_url(); ?>channel/<?php echo $channel->channel_slug ?>">
			<div class="thumbnail">
				<div class="flex-media">
					<img src="http://img.youtube.com/vi/<?php echo $this->Song_model->getChannelImage($channel->channel_slug) ?>/hqdefault.jpg" alt="<?php echo $channel->channel_name ?>">
				</div>
			</div>
			<h2><?php echo $channel->channel_name ?></h2>
		</a>

		<?php endforeach; ?>
	</section>
	
	<?php $this->load->view('includes/links'); ?>
	
</div>
<?php $this->load->view('includes/footer'); ?>