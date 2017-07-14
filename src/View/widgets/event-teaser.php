<?php
$width = isset($width) ? $width : 400;
$height = isset($height) ? $height : 400;

if (!empty($event->image)):
  $img_url = urlencode(str_replace("/", "|", $event->image))
            . '/' . $width . '/' . $height;
else:
  $img_url = urlencode(str_replace("/", "|", realpath("public/style/teaser-background.png")))
           . '/' . $width . '/' . $height;
endif;
$date = date('d/m/Y', strtotime($event->created_at));
$time = date('H:i', strtotime($event->created_at));
?>
<article class="teaser teaser-zoom-rotate" style="max-width: <?= $width ?>px; max-height: <?= $height ?>px;">
  <a href="/calendario/<?= $event->id ?>">
    <img src="/image/<?= $img_url ?>" alt="<?= $event->name ?>" class="img-responsive">
    <div class="teaser-info">
      <h4><?= $event->name ?></h4>
      <div class="text-right">
        <small>Il <?= $date ?> alle <?= $time ?> presso <?= $event->place ?></small>
      </div>
    </div>
  </a>
</article>
