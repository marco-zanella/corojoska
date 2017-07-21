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
?>
<article itemscope itemtype="http://schema.org/CreativeWork">
  <div class="teaser teaser-zoom teaser-large">
    <a href="/blog/<?= $post->id ?>" title="Leggi l'articolo">
      <img src="<?= $img_url ?>" alt="<?= $post->title ?>" class="img-responsive img-thumbnail" itemprop="image">
    </a>
    <div class="teaser-info">
      <h3 itemprop="name"><?= $post->title ?></h3>
      <div class="teaser-showup">
        <p itemprop="text"><?= $post->getSummary($length) ?></p>
        <p class="text-right">
          <small class="pull-left">
            Pubblicato il 
            <time itemprop="datePublished"><?= date('d/m/Y, \a\l\l\e H:i', strtotime($post->created_at)) ?></time>
          </small>
          <a href="/blog/<?= $post->id ?>" title="Leggi l'articolo" class="btn btn-default">Leggi tutto <span class="glyphicon glyphicon-eye-open"></span></a>
        </p>
      </div>
    </div>
  </div>
</article>

