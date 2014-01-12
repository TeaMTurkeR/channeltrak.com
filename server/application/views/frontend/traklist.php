<?php $this->load->view('frontend/includes/header'); ?>

<section id="trak-list" class="horizontal">

	<?php foreach ($traks as $trak) : ?>

		<article id="<?php echo $trak->id; ?>" class="trak" data-youtube-id="<?php echo $trak->youtube_id; ?>">
			<section class="media">
				<img src="http://img.youtube.com/vi/<?php echo $trak->youtube_id; ?>/hqdefault.jpg" alt="">
			</section>
			<section class="caption">
				<h2><?php echo $trak->title ?></h2>
				<p><a href="<?php echo base_url(); ?>index.php/channel/<?php echo $trak->channel_slug ?>"><i class="icon-share-alt"></i> <?php echo $trak->channel_title ?></a></p>
				<div>
					<p><?php echo number_format($trak->views) ?><i class="icon-eye-open"></i></p>	
					<p><?php echo date('F j', strtotime($trak->uploaded)); ?></p>	
				</div>
			</section>
		</article>

	<?php endforeach; ?>

</section>

<?php $this->load->view('frontend/includes/footer'); ?>