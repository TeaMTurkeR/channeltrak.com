<?php $this->load->view('includes/header'); ?>

	<div id="wrap">
		<nav id="nav">
			<?php $this->load->view('includes/side'); ?>
		</nav>

		<section id="info">
			<h2 id="page-title"><?php echo $title; ?></h2>
			<?php if (isset($subtitle)) : ?>
			<h3 id="page-subtitle"><?php echo $subtitle; ?></h3>
			<?php else : ?>
			<h3 id="page-subtitle"><span>Added May 3rd 2013</span><span><a href="">Visit on YouTube</a></span></h3>
			<h3 id="totals"><span id="total-favorites">2200 Pins</span><span id="total-songs">24 Uploads</span></h3>
			<?php endif; ?>

		</section>

		<section id="playlist">
			<?php $this->load->view('includes/controls'); ?>
			<?php $this->load->view('includes/loop'); ?>
		</section>

		<?php if (isset($pagination)) : ?>
		<section id="pagination">
			<button id="load-more" data-offset="0">Load More</button>
		</section>
		<?php endif; ?>
	</div>

	<footer id="footer">
		<ul class="inline-list left">
			<li><a href="">About</a></li>
			<li><a href="">Contact</a></li>
			<li><a href="">Terms</a></li>
			<li><a href="">Privacy</a></li>
		</ul>
		<ul class="inline-list right">
			<li>&copy Channeltrak 2013</li>
		</ul>
	</footer>

<?php $this->load->view('includes/footer'); ?>