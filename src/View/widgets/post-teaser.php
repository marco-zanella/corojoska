<?php
$width = isset($width) ? $width : 400;
$height = isset($height) ? $height : 200;
$max_length = isset($max_length) ? $max_length : 24;

$title_short = strlen($post->title) <= $max_length ? $post->title : (substr($post->title, 0, $max_length - 3) . "...");
$img_url = '/image/' . urlencode(str_replace("/", "|", $post->image))
          . '/' . $width . '/' . $height;
$date = date('d/m/Y, H:i', strtotime($post->created_at));
?>
<article class="teaser teaser-zoom-rotate" style="max-width: <?= $width ?>px; max-height: <?= $height ?>px;" itemscope itemtype="http://schema.org/CreativeWork">
  <a href="/blog/<?= $post->id ?>" title="Leggi l'articolo">
    <img src="/image/<?= $img_url ?>" alt="<?= $post->title ?>" class="img-responsive" itemprop="image">
    <div class="teaser-info">
      <h4 itemprop="name"><?= $title_short ?></h4>
      <span class="hidden" itemprop="name"><?= $post->title ?></span>
      <div class="text-right">
        <small>Pubbicato il: <span itemprop="datePublished"><?= $date ?></span></small>
      </div>
    </div>
  </a>
</article>
