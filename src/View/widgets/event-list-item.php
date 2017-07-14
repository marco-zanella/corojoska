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
$date = date('d/m/Y', strtotime($event->created_at));
$time = date('H:i', strtotime($event->created_at));

$description = strip_tags($event->description);
if (strlen($description) > $length):
  $description = substr($description, 0, $length - 3) . "...";
endif;
?>
<article class="media">
  <div class="media-left media-middle">
    <a href="/calendario/<?= $event->id ?>">
      <img class="media-object" src="<?= $img_url ?>" alt="<?= $event->name ?>">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?= $event->name ?></h4>
    <?= $description ?>
    <a href="/calendario/<?= $event->id ?>">Leggi tutto</a>
  </div>
</article>
