<?php
$width = isset($width) ? $width : 400;
$height = isset($height) ? $height : 200;
$length = isset($length) ? $length : 200;

$img_url = '/image/' . urlencode(str_replace("/", "|", $post->image))
          . '/' . $width . '/' . $height;
$date = date('d/m/Y, H:i', strtotime($post->created_at));

$content = strip_tags($post->content);
if (strlen($content) > $length):
  $content = substr($content, 0, $length - 3) . "...";
endif;
?>
<article class="thumbnail">
  <img src="<?= $img_url ?>" alt="<?= $post->title ?>">
  <div class="caption">
    <h3><?= $post->title ?></h3>
    <p><?= $content ?></p>
    <p class="text-right"><a href="/blog/<?= $post->id ?>" class="btn btn-primary" role="button">Visualizza</a></p>
  </div>
</article>
