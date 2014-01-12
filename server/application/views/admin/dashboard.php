<?php $this->load->view('admin/includes/header'); ?>

<section id="dashboard">
	<div class="center">

		<?php if ($unapproved == NULL) : ?>
			
			<!-- NOTHING UNAPPROVED -->

		<?php elseif (count($unapproved) == 1) : ?>

			<?php $channel = $unapproved; ?>

			<table id="unapproved">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Uploads</th>
						<th>Last Updated</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $channel->id; ?></td>
						<td><?php echo $channel->title; ?></td>
						<td><?php echo $channel->trak_count; ?></td>
						<td><?php echo $channel->updated; ?></td>
					</tr>
				</tbody>
			</table>	
		
		<?php else :  ?>

			<table id="unapproved">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Uploads</th>
						<th>Last Updated</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($unapproved as $channel) : ?>
					<tr>
						<td><?php echo $channel->id; ?></td>
						<td><?php echo $channel->title; ?></td>
						<td><?php echo $channel->trak_count; ?></td>
						<?php if (strtotime($channel->updated) != '0000-00-00 00:00:00') : ?>
							<td><?php echo floor((strtotime(date('Y-m-d H:i:s')) - strtotime($channel->updated))/60/60); ?> Hours</td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>	
				</tbody>
			</table>	

		<?php endif; ?>
			
		<?php if ($approved == NULL) : ?>

			<p>Nothing Approved</p>

		<?php elseif (count($approved) == 1) : ?>

			<?php $channel = $approved; ?>

			<table id="approved">
				<thead>
					<tr>
						<th width="50px">#</th>
						<th width="550px">Title</th>
						<th width="100px">Uploads</th>
						<th width="100px">Last Updated</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($approved as $channel) : ?>
					<tr>
						<td><?php echo $channel->id; ?></td>
						<td><?php echo $channel->title; ?></td>
						<td><?php echo $channel->trak_count; ?></td>
						<?php echo $channel->updated ?>
						<?php if (strtotime($channel->updated) != '0000-00-00 00:00:00') : ?>
							<td><?php echo floor((strtotime(date('Y-m-d H:i:s')) - strtotime($channel->updated))/60/60); ?> Hours</td>
						<?php endif; ?>
						<td><a href="<?php echo base_url(); ?>index.php/edit/<?php echo $channel->id; ?>">Edit</a></td>
					</tr>
				<?php endforeach; ?>	
				</tbody>
			</table>
		
		<?php else :  ?>

			<table id="approved">
				<thead>
					<tr>
						<th width="50px">#</th>
						<th width="550px">Title</th>
						<th width="100px">Uploads</th>
						<th width="100px">Last Updated</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($approved as $channel) : ?>
					<tr>
						<td><?php echo $channel->id; ?></td>
						<td><?php echo $channel->title; ?></td>
						<td><?php echo $channel->trak_count; ?></td>
						<?php if ($channel->updated != 0) : ?>
							<td><?php echo floor((strtotime(date('Y-m-d H:i:s')) - strtotime($channel->updated))/60/60); ?> Hours Ago</td>
						<?php else : ?>
							<td>Never</td>
						<?php endif; ?>
						<td><a href="<?php echo base_url(); ?>index.php/edit/<?php echo $channel->id; ?>">Edit</a></td>
					</tr>
				<?php endforeach; ?>	
				</tbody>
			</table>

		<?php endif; ?>

		<hr>

		<?php echo form_open('channels/create', array('class' => 'pure-form pure-form-aligned')); ?>

			<div class="pure-control-group">
	            <label for="title">Title</label>
	            <input name="title" type="text" placeholder="Title">
	        </div>
			
			<div class="pure-control-group">
	            <label for="youtube_id">Youtube ID</label>
	            <input name="youtube_id" type="text" placeholder="Youtube ID">
	        </div>

			<div class="pure-controls">
				<input class="pure-button pure-button-primary" type="submit" value="Add">
			</div>

		<?php echo form_close(); ?>

	</div>
</section>

<?php $this->load->view('admin/includes/footer'); ?>