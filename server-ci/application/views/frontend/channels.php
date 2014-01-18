<?php $this->load->view('frontend/includes/header'); ?>

<section id="channel-grid">

	<?php foreach ($channels as $channel) : ?>

		<article class="channel">
			<section class="cover">
				<img src="http://img.youtube.com/vi/<?php echo $channel->cover_id; ?>/hqdefault.jpg" alt="<?php echo $channel->title; ?> on Channeltrak">
			</section>
			<h2><a href="<?php echo base_url(); ?>channel/<?php echo $channel->slug; ?>"><?php echo $channel->title; ?></a></h2>
		</article>

	<?php endforeach; ?>

</section>

<?php $this->load->view('frontend/includes/footer'); ?>