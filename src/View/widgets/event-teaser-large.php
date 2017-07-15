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

if (!empty($event->summary)):
  $summary = $event->summary;
elseif (strlen(strip_tags($event->description)) <= $length):
  $summary = strip_tags($event->description);
else:
  $summary = substr(strip_tags($event->description), 0, $length - 3) . "...";
endif;
?>
<article>
  <div class="teaser teaser-zoom teaser-large">
    <a href="/calendario/<?= $event->id ?>" title="Visualizza">
      <img src="<?= $img_url ?>" alt="<?= $event->name ?>" class="img-responsive img-thumbnail">
    </a>
    <div class="teaser-info">
      <h3><?= $event->name ?></h3>
      <div class="teaser-showup">
        <dl class="dl-horizontal">
          <dt>Luogo:</dt>
          <dd><?= $event->place ?></dd>

          <dt>Data:</dt>
          <dd><?= $date ?>, alle ore <?= $time ?></dd>
        </dl>

        <p><?= $summary ?></p>
        <p class="text-right">
          <a href="/calendario/<?= $event->id ?>" title="Visualizza" class="btn btn-primary">Visualizza <span class="glyphicon glyphicon-eye-open"></span></a>
        </p>
      </div>
    </div>
  </div>
</article>
