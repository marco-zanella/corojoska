<?php
$width = isset($width) ? $width : 900;
$height = isset($height) ? $height : 450;
$length = isset($length) ? $length : 200;

if (!empty($post->image)):
  $img_url = '/image/' . urlencode(str_replace("/", "|", $post->image))
            . '/' . $width . '/' . $height;
else:
  $img_url = '/image/' . urlencode(str_replace("/", "|", realpath("public/style/teaser-background.png")))
           . '/' . $width . '/' . $height;
endif;
$date = date('d/m/Y', strtotime($post->date));
$time = date('H:i', strtotime($post->date));

if (!empty($post->summary)):
  $summary = $post->summary;
elseif (strlen(strip_tags($post->content)) <= $length):
  $summary = strip_tags($post->content);
else:
  $summary = substr(strip_tags($post->content), 0, $length - 3) . "...";
endif;
?>
<article>
  <div class="teaser teaser-zoom teaser-large">
    <a href="/blog/<?= $post->id ?>" title="Visualizza">
      <img src="<?= $img_url ?>" alt="<?= $post->title ?>" class="img-responsive img-thumbnail">
    </a>
    <div class="teaser-info">
      <h3><?= $post->title ?></h3>
      <div class="teaser-showup">
        <p><?= $summary ?></p>
        <p class="text-right">
          <a href="/blog/<?= $post->id ?>" title="Visualizza" class="btn btn-primary">Visualizza <span class="glyphicon glyphicon-eye-open"></span></a>
        </p>
      </div>
    </div>
  </div>
</article>

