<?php $this->load->view('includes/header'); ?>
<div id="page">
	<?php $this->load->view('includes/side'); ?>
	<?php $this->load->view('includes/ads'); ?>
	
	<?php $this->load->view('includes/info'); ?>

	<section id="main">		
		<?php echo form_open('channel/submit', 'id=submit class=form' ); ?>
			<?php if(isset($success)) : ?>
			<p class="success"><?php echo $success ?></p>
			<?php endif ?>

			<?php if(isset($error)) : ?>
			<p class="error"><?php echo $error ?></p>
			<?php endif ?>

			<label for="name">Channel Name</label>
			<input type="text" name="name" required>

			<label for="youtube">Youtube URL</label>
			<input type="text" name="youtube" required>
			
			<label for="twitter">Twitter URL (optional)</label>
			<input type="text" name="twitter">

			<label for="facebook">Facebook URL (optional)</label>
			<input type="text" name="facebook">

			<label for="website">Website URL (optional)</label>
			<input type="text" name="website">

			<input class="button" type="submit" value="Submit">
		<?php echo form_close(); ?>

		<div class="form-side">
			<h3>Good channels have:</h3>
			<ul>
				<li>Consistently good music<br>(genre doesn't matter)</li>
				<li>High quality visuals<br>(extra points for animations and actual videos)</li>
				<li>Posts that don't get taken down</li>
			</ul>
			<p>Keep an eye on our <a href="http://twitter.com/channeltrak">twitter</a> to see if your submission has be selected.</p>
		</div>
	</section>

	<?php $this->load->view('includes/links'); ?>

</div>
<?php $this->load->view('includes/footer'); ?>