<?php
$width = isset($width) ? $width : 64;
$height = isset($height) ? $height : 64;
$length = isset($length) ? $length : 128;

$img_url = '/image/' . urlencode(str_replace("/", "|", $post->image))
          . '/' . $width . '/' . $height;
$date = date('d/m/Y, H:i', strtotime($post->created_at));

$content = strip_tags($post->content);
if (strlen($content) > $length):
  $content = substr($content, 0, $length - 3) . "...";
endif;
?>
<article class="media">
  <div class="media-left media-middle">
    <a href="/blog/<?= $post->id ?>">
      <img class="media-object" src="<?= $img_url ?>" alt="<?= $post->title ?>">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?= $post->title ?></h4>
    <?= $content ?>
    <a href="/blog/<?= $post->id ?>">Leggi tutto</a>
  </div>
</article>
