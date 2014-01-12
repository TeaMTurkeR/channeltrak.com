<?php $this->load->view('includes/header'); ?>

<section id="edit">
	<div class="center">

		<h2><?php echo $channel->title; ?></h2>

		<?php if ($traks == NULL) : ?>
			
			<!-- NO SONGS -->

		<?php elseif (count($traks) == 1) : ?>

			<table>
				<thead>
					<tr>
						<th width="50px">#</th>
						<th width="550px">Title</th>
						<th width="100px">Views</th>
						<th width="100px">Uploaded</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $trak->id; ?></td>
						<td><?php echo $trak->title; ?></td>
						<td><?php echo $trak->views; ?></td>
						<td><?php echo date('M j', strtotime($trak->uploaded)); ?></td>
						<td><a href="">Delete</a></td>
					</tr>
				</tbody>
			</table>	
		
		<?php else :  ?>

			<table>
				<thead>
					<tr>
						<th width="50px">#</th>
						<th width="550px">Title</th>
						<th width="100px">Views</th>
						<th width="100px">Uploaded</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($traks as $trak) : ?>
					<tr>
						<td><?php echo $trak->id; ?></td>
						<td><?php echo $trak->title; ?></td>
						<td><?php echo $trak->views; ?></td>
						<td><?php echo date('M j', strtotime($trak->uploaded)); ?></td>
						<td><a href="">Delete</a></td>
					</tr>
				<?php endforeach; ?>	
				</tbody>
			</table>	

		<?php endif; ?>
			
	</div>
</section>

<?php $this->load->view('includes/footer'); ?>