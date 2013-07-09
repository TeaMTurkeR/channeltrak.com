<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc><?php echo base_url(); ?></loc> 
        <priority>1.0</priority>
    </url>

    <?php foreach($channels as $channel) : ?>
    <url>
        <loc><?php echo base_url(); ?>channel/<?php echo $channel ?></loc>
        <changefreq>Monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <?php endforeach; ?>

    <?php foreach($songs as $song) : ?>
    <url>
        <loc><?php echo base_url(); ?>song/<?php echo $song ?></loc>
        <changefreq>Monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <?php endforeach; ?>
    
</urlset>