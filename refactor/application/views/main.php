<?php $this->load->view('includes/header'); ?>
<div id="page">
	<?php $this->load->view('includes/side'); ?>
	
	<?php $this->load->view('includes/info'); ?>


	<section id="playlist">
		<?php $this->load->view('includes/controls'); ?>
		<?php $this->load->view('includes/loop'); ?>
	</section>

	<?php if (isset($pagination)) : ?>
	<section id="pagination">
		<button id="load-more" class="button" data-offset="0">Load More</button>
	</section>
	<?php endif; ?>

	<?php $this->load->view('includes/links'); ?>

</div>
<?php $this->load->view('includes/footer'); ?>