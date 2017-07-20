<?php
$width = isset($width) ? $width : 64;
$height = isset($height) ? $height : 64;
$length = isset($length) ? $length : 128;

if (!empty($event->image)):
  $img_url = '/image/' . urlencode(str_replace("/", "|", $event->image))
            . '/' . $width . '/' . $height;
else:
  $img_url = '/image/' . urlencode(str_replace("/", "|", realpath("public/style/teaser-background.png")))
           . '/' . $width . '/' . $height;
endif;
?>
<article class="media" itemscope itemtype="http://schema.org/MusicEvent">
  <div class="media-left media-middle">
    <a href="/calendario/<?= $event->id ?>">
      <img class="media-object" src="<?= $img_url ?>" alt="<?= $event->name ?>" itemprop="image">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><a href="/calendario/<?= $event->id ?>" itemprop="name"><?= $event->name ?></a></h4>
    <div itemprop="description"><?= $event->getSummary($length) ?></div>
    <a href="/calendario/<?= $event->id ?>">Leggi tutto</a>
    <span class="hidden">
      <time itemprop="startDate"><?= $event->date ?></time>
      <span itemptop="location"><?= $event->place ?></span>
    </span>
  </div>
</article>
