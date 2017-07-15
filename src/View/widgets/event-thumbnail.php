<?php
$width = isset($width) ? $width : 400;
$height = isset($height) ? $height : 400;
$length = isset($length) ? $length : 200;

if (!empty($event->image)):
  $img_url = '/image/' . urlencode(str_replace("/", "|", $event->image))
            . '/' . $width . '/' . $height;
else:
  $img_url = '/image/' . urlencode(str_replace("/", "|", realpath("public/style/teaser-background.png")))
           . '/' . $width . '/' . $height;
endif;
$date = date('d/m/Y', strtotime($event->created_at));
$time = date('H:i', strtotime($event->created_at));
?>
<article class="thumbnail" itemscope itemtype="http://schema.org/MusicEvent">
  <a href="/calendario/<?= $event->id ?>" title="Visualizza">
    <img src="<?= $img_url ?>" alt="<?= $event->name ?>" itemprop="image">
  </a>
  <div class="caption">
    <h3 itemprop="name"><?= $event->name ?></h3>
    <dl class="dl-horizontal">
      <dt>Luogo:</dt>
      <dd itemprop="location"><?= $event->place ?></dd>

      <dt>Data:</dt>
      <dd><?= $date ?>, alle ore <?= $time ?></dd>
    </dl>
    <p itemprop="description"><?= $event->getSummary() ?></p>
    <p class="text-right">
      <a href="/calendario/<?= $event->id ?>" class="btn btn-primary" role="button">Visualizza</a>
      <span class="hidden">
        <time itemprop="startDate"><?= $event->date ?></time>
      </span>
    </p>
  </div>
</article>
