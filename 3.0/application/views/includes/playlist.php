<?php foreach ($rows as $row) { ?>
	<article class="song">
		<section class="thumbnail">
			<div class="aspect-ratio">
				<img src="http://img.youtube.com/vi/<?php echo $row->song_yt_id ?>/hqdefault.jpg">
			</div>
		</section>
		<footer class="content">
			<h2><a href="/song/<?php echo $row->song_slug ?>"><?php echo $row->song_title ?></a></h2>
			<p class="date"><?php echo date('F j', strtotime($row->song_uploaded)); ?></p>
		</footer>
	</article>
<?php } ?>