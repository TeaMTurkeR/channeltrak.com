<?php 

	$data['title'] = 'Channeltrak';
	$this->load->view('includes/header', $data);
	//$this->load->view('nav'); 

?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('includes/playlist'); ?>
	</div>
</div>

<?php $this->load->view('includes/footer');?>