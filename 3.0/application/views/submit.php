<?php 

	$data['title'] = 'Submit | Channeltrak';
	$this->load->view('includes/header', $data);

?>

<section class="row">
	<aside id="side" class="large-4 columns">
		<?php $this->load->view('includes/side'); ?>
	</aside>
	<section id="main" class="large-4 large-centered columns">
		<?php echo form_open('channel/submit'); ?>
			<fieldset>
				<legend>Submit a Channel</legend>

					<label for="name">Channel Name</label>
					<input type="text" name="name">

					<label for="url">Channel URL</label>
					<input type="text" name="url">

					<input class="button small expand" type="submit" value="Submit">
					
			</fieldset>
		<?php echo form_close(); ?>
	</section>
</section>

<?php $this->load->view('includes/footer');?>