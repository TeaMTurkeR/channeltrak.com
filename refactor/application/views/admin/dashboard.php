<?php $this->load->view('admin/header'); ?>

    <div class="container">

    	<div class="row">
    		
			<div class="span8">
				<h3>Channels</h3>
				
				<table class="table table-bordered">

					<thead>
						<tr>
							<th>Name</th>
							<th>Status</th>
							<th>Tracks</th>
							<th>Favorites</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

					<?php if ( isset($unapproved) ) : ?>
					<?php foreach ($unapproved as $channel) : ?>
					
						<tr>
							<td><?php echo $channel->channel_name ?></td>
							<td style="color:red">Unapproved</td>
							<td>N/A</td>
							<td>N/A</td>
							<td><a class="btn" href="<?php echo base_url(); ?>index.php/edit/<?php echo $channel->channel_slug ?>">Edit</a></td>
						</tr>

					<?php endforeach; ?>
					<?php endif; ?>
					
					<?php if ( isset($approved) ) : ?>
					<?php foreach ($approved as $channel) : ?>
		
						<tr>
							<td><?php echo $channel->channel_name ?></td>
							<td style="color:green">Approved</td>
							<td><?php echo $channel->channel_tracks ?></td>
							<td><?php echo $channel->channel_favorites ?></td>
							<td><a class="btn" href="<?php echo base_url(); ?>index.php/edit/<?php echo $channel->channel_slug ?>">Edit</a></td>
						</tr>

					<?php endforeach; ?>
					<?php endif; ?>
					
					</tbody>
				</table>
				
				<a class="btn btn-primary btn-block" href="<?php echo base_url(); ?>index.php/channel/import">Import Posts</a>

			</div>

			<div class="span4">
				<h3>Twitter</h3>
				<a class="twitter-timeline" href="https://twitter.com/search?q=%40channeltrak" data-widget-id="345966916994740224">Tweets about "@channeltrak"</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>

    	</div>

    </div> <!-- /container -->

<?php $this->load->view('admin/footer'); ?>