<?php
header('Content-Type: application/xml; charset=utf-8');

function url($path) {
    return 'http://' . $_SERVER['HTTP_HOST'] . $path;
}

$date = date('Y-m-d');
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

  <url>
    <loc><?= url('') ?></loc>
    <lastmod><?= $date ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>

  <url>
    <loc><?= url('/blog') ?></loc>
    <lastmod><?= $date ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>

  <url>
    <loc><?= url('/calendario') ?></loc>
    <lastmod><?= $date ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>

  <url>
    <loc><?= url('/biografia') ?></loc>
    <lastmod><?= $date ?></lastmod>
    <changefreq>yearly</changefreq>
    <priority>0.6</priority>
  </url>

  <url>
    <loc><?= url('/repertorio') ?></loc>
    <lastmod><?= $date ?></lastmod>
    <changefreq>yearly</changefreq>
    <priority>0.6</priority>
  </url>

  <url>
    <loc><?= url('/contatti') ?></loc>
    <lastmod><?= $date ?></lastmod>
    <changefreq>yearly</changefreq>
    <priority>0.5</priority>
  </url>

  <url>
    <loc><?= url('/login') ?></loc>
    <lastmod><?= $date ?></lastmod>
    <changefreq>never</changefreq>
    <priority>0.1</priority>
  </url>

  <?php foreach ($posts as $post): ?>
  <url>
    <loc><?= url('/blog/' . $post->id) ?></loc>
    <lastmod><?= $date ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach; ?>

  <?php foreach ($events as $event): ?>
  <url>
    <loc><?= url('/calendario/' . $event->id) ?></loc>
    <lastmod><?= $date ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach; ?>
</urlset>
