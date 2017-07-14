<?php
$width = isset($width) ? $width : 400;
$height = isset($height) ? $height : 200;

$img_url = urlencode(str_replace("/", "|", $post->image))
          . '/' . $width . '/' . $height;
$date = date('d/m/Y, H:i', strtotime($post->created_at));
?>
<article class="teaser teaser-zoom-rotate" style="max-width: <?= $width ?>px; max-height: <?= $height ?>px;">
  <a href="/blog/<?= $post->id ?>">
    <img src="/image/<?= $img_url ?>" alt="<?= $post->title ?>" class="img-responsive">
    <div class="teaser-info">
      <h4><?= $post->title ?></h4>
      <div class="text-right">
        <small>Pubbicato il: <?= $date ?></small>
      </div>
    </div>
  </a>
</article>
