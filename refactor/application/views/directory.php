<?php $this->load->view('includes/header'); ?>
<div id="page">
	<nav id="nav">
		<?php $this->load->view('includes/side'); ?>
	</nav>

	<section id="info">
		<?php $this->load->view('includes/info'); ?>
	</section>

	<section id="directory">
		<?php foreach ($channels as $channel) : ?>
		
		<a class="channel" href="<?php echo base_url(); ?>index.php/channel/<?php echo $channel->channel_slug ?>">
			<div class="thumbnail">
				<div class="flex-media">
					<img src="http://img.youtube.com/vi/<?php echo $this->Song_model->getChannelImage($channel->channel_slug) ?>/hqdefault.jpg" alt="<?php echo $channel->channel_name ?>">
				</div>
			</div>
			<h2><?php echo $channel->channel_name ?></h2>
		</a>

		<?php endforeach; ?>
	</section>

	<footer id="footer">
		<ul class="inline left">
			<li><a href="">About</a></li>
			<li><a href="">Contact</a></li>
			<li><a href="">Terms</a></li>
			<li><a href="">Privacy</a></li>
		</ul>
		<ul class="inline right">
			<li>&copy Channeltrak 2013</li>
		</ul>
	</footer>
</div>
<?php $this->load->view('includes/footer'); ?>