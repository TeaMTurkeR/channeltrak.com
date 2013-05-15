<?php $this->load->view('includes/header'); ?>

<section class="row">
	<aside id="side" class="large-3 columns">
		<?php $this->load->view('includes/side'); ?>
	</aside>
	<section id="main" class="large-9 columns">
		<?php $this->load->view('includes/controls'); ?>
		<div id="loop">
			<?php $this->load->view('includes/loop'); ?>
		</div>
		<button id="load-more" data-offset="0">Load More</button>
	</section>
</section>

<?php $this->load->view('includes/footer');?>