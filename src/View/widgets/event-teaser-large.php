<?php
$width = isset($width) ? $width : 900;
$height = isset($height) ? $height : 450;
$length = isset($length) ? $length : 200;

if (!empty($event->image)):
  $img_url = '/image/' . urlencode(str_replace("/", "|", $event->image))
            . '/' . $width . '/' . $height;
else:
  $img_url = '/image/' . urlencode(str_replace("/", "|", realpath("public/style/teaser-background.png")))
           . '/' . $width . '/' . $height;
endif;
$date = date('d/m/Y', strtotime($event->date));
$time = date('H:i', strtotime($event->date));
?>
<article itemscope itemtype="http://schema.org/MusicEvent">
  <div class="teaser teaser-zoom teaser-large">
    <a href="/calendario/<?= $event->id ?>" title="Visualizza">
      <img src="<?= $img_url ?>" alt="<?= $event->name ?>" class="img-responsive img-thumbnail" itemprop="image">
    </a>
    <div class="teaser-info">
      <h3 itemprop="name"><?= $event->name ?></h3>
      <div class="teaser-showup">
        <dl class="dl-horizontal">
          <dt>Luogo:</dt>
          <dd itemprop="location"><?= $event->place ?></dd>

          <dt>Data:</dt>
          <dd itemprop="startDate"><?= $date ?>, alle ore <?= $time ?></dd>
        </dl>

        <p itemprop="description"><?= $event->getSummary($length) ?></p>
        <p class="text-right">
          <a href="/calendario/<?= $event->id ?>" title="Visualizza" class="btn btn-primary">Visualizza <span class="glyphicon glyphicon-eye-open"></span></a>
        </p>
      </div>
    </div>
  </div>
</article>
