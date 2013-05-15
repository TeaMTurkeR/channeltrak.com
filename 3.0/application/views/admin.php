<?php 
	
	if ( $this->session->userdata('logged_in') && $this->session->userdata('user_name') == 'Admin' ) {

		$data['title'] = 'Admin | Channeltrak';
		$this->load->view('includes/header', $data);

?>

<form id="update" action="http://localhost/channeltrak.com/3.0/index.php/channel/approve" method="post" accept-charset="utf-8" style="display:none;"></form>
<div class="row">
	<div class="large-12 columns">
		<h1>Admin</h1>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		<h3>Submitted</h3>
		<table style="width:100%;">
			<thead>
				<tr>
					<th width="75">ID</th>
					<th>Name</th>
					<th>URL</th>
					<th>Youtube ID</th>
					<th></th>
				</tr>
			</thead>	

			<tbody>
				<?php foreach ($submitted as $row) { ?>

				<tr class="form">
					<td>
						<input type="hidden" name="id" value="<?php echo $row->channel_id ?>">
						<?php echo $row->channel_id ?>
					</td>
					<td><input type="text" name="name" value="<?php echo $row->channel_name ?>"></td>
					<td><input type="text" name="url" value="<?php echo $row->channel_yt_id ?>"></td>
					<td><input type="text" name="yt-id" value="<?php echo $row->channel_yt_id ?>"></td>
					<td><button class="small success" type="submit" onclick="submitForm(this);">Approve</button></td>
				</tr>

				<?php } ?>
			</tbody>

		</table>
	</div>
</div>

<div class="row">
	<div class="large-12 columns">
		<h3>Approved</h3>
		<table style="width:100%;">
			<thead>
				<tr>
					<th width="75">ID</th>
					<th>Name</th>
					<th>Slug</th>
					<th>Youtube ID</th>
					<th>Date Approved</th>
				</tr>
			</thead>	

			<tbody>
				<?php foreach ($approved as $row) { ?>

				<tr class="form">
					<td>
						<input type="hidden" name="id" value="<?php echo $row->channel_id ?>">
						<?php echo $row->channel_id ?>
					</td>
					<td><input type="text" name="name" value="<?php echo $row->channel_name ?>"></td>
					<td><input type="text" name="name" value="<?php echo $row->channel_slug ?>" disabled></td>
					<td><input type="text" name="yt-id" value="<?php echo $row->channel_yt_id ?>"></td>
					<td><input type="text" name="yt-id" value="<?php echo $row->channel_approved ?>" disabled></td>
				</tr>

				<?php } ?>
			</tbody>

		</table>
	</div>
</div>

<?php 
	
		$this->load->view('includes/footer');

	} else {
		redirect('/', 'refresh');
	}
?>