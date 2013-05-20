<?php $this->load->view('includes/header'); ?>
<div id="page">
	<nav id="nav">
		<?php $this->load->view('includes/side'); ?>
	</nav>

	<section id="main">
		<?php echo form_open('index.php/user/login'); ?>
			<fieldset>

					<label for="email">Email</label>
					<input type="text" name="email">
					
					<label for="password">Password</label>
					<input type="password" name="password">

					<input class="button small expand" type="submit" value="Login">

			</fieldset>
		<?php echo form_close(); ?>
	</section>

	<?php if (isset($pagination)) : ?>
	<section id="pagination">
		<button id="load-more" data-offset="0">Load More</button>
	</section>
	<?php endif; ?>

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