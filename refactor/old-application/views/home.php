<?php $this->load->view('includes/header'); ?>

<header id="splash">
	
	<div class="row">
		<div class="large-3 columns">
			<h1>Channeltrak</h1>
			<p>Consolidating the best music oriented YouTube channels in one place.</p>
			<button id="start" class="expand success">Start Listening</button>
		</div>
	</div>

</header>

<section class="row">
	<aside id="side" class="large-3 columns">
		<?php $this->load->view('includes/side'); ?>
	</aside>
	<section id="main" class="large-9 columns">
		<?php $this->load->view('includes/controls'); ?>
		<div id="loop">
			<?php $this->load->view('includes/loop'); ?>
		</div>
		<button id="load-more" data-offset="0" class="large-11">Load More</button>
	</section>
</section>

<?php $this->load->view('includes/footer');?>