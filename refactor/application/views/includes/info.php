<h2 id="page-title"><?php echo $title; ?></h2>

<?php if (isset($subtitle)) : ?>

<h3 id="page-subtitle"><?php echo $subtitle; ?></h3>

<?php else : ?>

<h3 id="page-subtitle">Joined Jan 3 2013</h3>
<ul class="page-info">
	<li>24 Posts</li>
	<li>2200 Pins</li>
</ul>
<ul class="inline">
	<li><a href=""><span class="icon-play-sign"></span> Youtube</a></li>
	<li><a href=""><span class="icon-twitter"></span> Twitter</a></li>
	<li><a href=""><span class="icon-facebook"></span> Facebook</a></li>
	<li><a href=""><span class="icon-external-link"></span> Website</a></li>
</ul>
<?php endif; ?>
