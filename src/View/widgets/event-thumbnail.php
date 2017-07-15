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

$description = strip_tags($event->description);
if (strlen($description) > $length):
  $description = substr($description, 0, $length - 3) . "...";
endif;
?>
<article class="thumbnail" itemscope itemtype="http://schema.org/MusicEvent">
  <a href="/calendario/<?= $event->id ?>" title="Visualizza">
    <img src="<?= $img_url ?>" alt="<?= $event->name ?>" itemprop="image">
  </a>
  <div class="caption">
    <h3 itemprop="name"><?= $event->name ?></h3>
    <p itemprop="description"><?= $description ?></p>
    <p class="text-right">
      <a href="/calendario/<?= $event->id ?>" class="btn btn-primary" role="button">Visualizza</a>
      <span class="hidden">
        <time itemprop="startDate"><?= $event->date ?></time>
        <span itemprop="location"><?= $event->place ?></time>
      </span>
    </p>
  </div>
</article>
