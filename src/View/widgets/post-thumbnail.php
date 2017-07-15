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
<article class="thumbnail" itemscope itemtype="http://schema.org/CreativeWork">
  <a href="/blog/<?= $post->id ?>" title="Visualizza">
    <img src="<?= $img_url ?>" alt="<?= $post->title ?>" itemprop="image">
  </a>
  <div class="caption">
    <h3 itemprop="name"><?= $post->title ?></h3>
    <p itemprop="text"><?= $content ?></p>
    <p class="text-right">
      <span class="hidden">Pubblicato il <time itemprop="datePublished"><?= $post->created_at ?></time></span>
      <a href="/blog/<?= $post->id ?>" class="btn btn-primary" role="button">Visualizza</a>
    </p>
  </div>
</article>
