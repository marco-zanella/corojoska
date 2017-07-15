<?php
$width = isset($width) ? $width : 64;
$height = isset($height) ? $height : 64;
$length = isset($length) ? $length : 128;

$img_url = '/image/' . urlencode(str_replace("/", "|", $post->image))
          . '/' . $width . '/' . $height;
?>
<article class="media" itemscope itemtype="http://schema.org/CreativeWork">
  <div class="media-left media-middle">
    <a href="/blog/<?= $post->id ?>">
      <img class="media-object" src="<?= $img_url ?>" alt="<?= $post->title ?>" itemprop="image">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading" itemprop="name"><?= $post->title ?></h4>
    <div itemprop="text"><?= $post->getSummary($length) ?></div>
    <a href="/blog/<?= $post->id ?>">Leggi tutto</a>
    <span class="hidden"><time itemprop="detePublished"><?= $post->created_at ?></time></span>
  </div>
</article>
