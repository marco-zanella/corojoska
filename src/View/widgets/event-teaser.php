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
$date = date('d/m/Y', strtotime($event->date));
$time = date('H:i', strtotime($event->date));
?>
<article class="teaser teaser-zoom-rotate" style="max-width: <?= $width ?>px; max-height: <?= $height ?>px;" itemscope itemtype="http://schema.org/MusicEvent">
  <a href="/calendario/<?= $event->id ?>">
    <img src="/image/<?= $img_url ?>" alt="<?= $event->name ?>" class="img-responsive" itemprop="image">
    <div class="teaser-info">
      <h4 itemprop="name"><?= $event->name ?></h4>
      <div class="text-right">
        <small>Il <?= $date ?> alle <?= $time ?> presso <?= $event->place ?></small>
        <span class="hidden">
          <time itemprop="startDate"><?= $event->date ?></time>
          <span itemprop="location"><?= $event->place ?></span>
        </span>
      </div>
    </div>
  </a>
</article>
