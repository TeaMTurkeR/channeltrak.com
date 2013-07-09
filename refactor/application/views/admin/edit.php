<?php $this->load->view('admin/header'); ?>
	
	<div class="container">
		
		<div class="row">

			<div class="span12">
				<div class="well">

				<h3><?php echo $channel->channel_name ?></h3>

			<?php if ($channel->channel_status == 'pending') : ?>
				
				<?php echo form_open('channel/approve', 'id=edit class=form' ); ?>
					<input type="hidden" name="id" value="<?php echo $channel->channel_id ?>">
					<input type="hidden" name="current" value="<?php echo $channel->channel_name ?>">

					<label for="name">Channel Name</label>
					<input class="input-xlarge" type="text" name="name" value="<?php echo $channel->channel_name ?>">

					<label for="slug">Channel Slug</label>
					<input class="input-xlarge" type="text" name="slug" value="<?php echo $channel->channel_slug ?>" disabled>

					<label for="yt-id">Youtube ID</label>
					<input class="input-large" type="text" name="yt-id" value="<?php echo $channel->channel_yt_id ?>" value="">

					<label for="cover-id">Cover Song ID</label>
					<input class="input-large" type="text" name="cover-id" value="<?php echo $channel->channel_cover_song_id ?>" value="">

					<label for="youtube">Youtube URL</label>
					<input class="input-xxlarge" type="text" name="youtube" value="<?php echo $channel->channel_yt_url ?>">
					
					<label for="twitter">Twitter URL</label>
					<input class="input-xxlarge" type="text" name="twitter" value="<?php echo $channel->channel_tw_url ?>">

					<label for="facebook">Facebook URL</label>
					<input class="input-xxlarge" type="text" name="facebook" value="<?php echo $channel->channel_fb_url ?>">

					<label for="website">Website URL</label>
					<input class="input-xxlarge" type="text" name="website" value="<?php echo $channel->channel_web_url ?>">
					
					<hr>

					<input class="btn btn-success" type="submit" value="Approve & Save">
					<a class="btn" href="<?php echo base_url(); ?>admin">Cancel</a>
				<?php echo form_close(); ?>

			<?php else : ?>

				<?php echo form_open('channel/update', 'id=edit class=form' ); ?>
					<input type="hidden" name="id" value="<?php echo $channel->channel_id ?>">
					<input type="hidden" name="current" value="<?php echo $channel->channel_name ?>">

					<label for="name">Channel Name</label>
					<input class="input-xlarge" type="text" name="name" value="<?php echo $channel->channel_name ?>">

					<label for="slug">Channel Slug</label>
					<input class="input-xlarge" type="text" name="slug" value="<?php echo $channel->channel_slug ?>" disabled>

					<label for="id">Youtube ID</label>
					<input class="input-large" type="text" name="yt-id" value="<?php echo $channel->channel_yt_id ?>" value="">

					<label for="cover-id">Cover Song ID</label>
					<input class="input-large" type="text" name="cover-id" value="<?php echo $channel->channel_cover_song_id ?>" value="">

					<label for="youtube">Youtube URL</label>
					<input class="input-xxlarge" type="text" name="youtube" value="<?php echo $channel->channel_yt_url ?>">
					
					<label for="twitter">Twitter URL</label>
					<input class="input-xxlarge" type="text" name="twitter" value="<?php echo $channel->channel_tw_url ?>">

					<label for="facebook">Facebook URL</label>
					<input class="input-xxlarge" type="text" name="facebook" value="<?php echo $channel->channel_fb_url ?>">

					<label for="website">Website URL</label>
					<input class="input-xxlarge" type="text" name="website" value="<?php echo $channel->channel_web_url ?>">
					
					<hr>
						
					<input class="btn btn-success" type="submit" value="Update">
					<a class="btn" href="<?php echo base_url(); ?>admin">Cancel</a>
				<?php echo form_close(); ?>

			<?php endif; ?>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="span12">
				
				<table class="table table-bordered">

					<tr>
						<th>#</th>
						<th width="10%">Video</th>
						<th>Title</th>
						<th>Favorites</th>
						<th></th>
					</tr>



				<?php if(isset($songs)) : ?>
					<?php foreach ($songs as $song) : ?>

					<tr>
						<td><?php echo $song->song_id ?></td>
						<td><img src="http://img.youtube.com/vi/<?php echo $song->song_yt_id; ?>/hqdefault.jpg"></td>
						<td><a href="<?php echo base_url(); ?>song/<?php echo $song->song_slug; ?>" title="<?php echo $song->song_title ?>"><?php echo $song->song_title ?></a></td>
						<td><?php echo $song->song_favorites ?></td>
						<td><a href="<?php echo base_url(); ?>song/delete/<?php echo $song->song_id; ?>" class="btn btn-danger">Delete</a></td>
					</tr>

					<?php endforeach; ?>
				<?php endif; ?>
			
				</table>

				<div class="well">
					<a class="btn btn-danger btn-block" href="<?php echo base_url(); ?>channel/delete/<?php echo $channel->channel_slug ?>">DELETE EVERYTHING!</a>
				</div>

			</div>

		</div>

	</div>

<?php $this->load->view('admin/footer'); ?>