<?php
$width = isset($width) ? $width : 400;
$height = isset($height) ? $height : 200;
$length = isset($length) ? $length : 200;

$img_url = '/image/' . urlencode(str_replace("/", "|", $post->image))
          . '/' . $width . '/' . $height;
?>
<article class="thumbnail" itemscope itemtype="http://schema.org/CreativeWork">
  <a href="/blog/<?= $post->id ?>" title="Leggi l'articolo">
    <img src="<?= $img_url ?>" alt="<?= $post->title ?>" itemprop="image">
  </a>
  <div class="caption">
    <h3 itemprop="name"><a href="/blog/<?= $post->id ?>" title="Leggi l'articolo"><?= $post->title ?></a></h3>
    <p itemprop="text"><?= $post->getSummary($length) ?></p>
    <p class="text-right">
      <small class="pull-left">
        Pubblicato il
        <time itemprop="datePublished"><?= date('d/m/Y, \a\l\l\e H:i', strtotime($post->created_at)) ?></time>
      </small>
      <a href="/blog/<?= $post->id ?>" title="Leggi l'articolo" class="btn btn-primary" role="button">Leggi tutto</a>
    </p>
  </div>
</article>
