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

if (!empty($post->summary)):
  $summary = $post->summary;
elseif (strlen(strip_tags($post->content)) <= $length):
  $summary = strip_tags($post->content);
else:
  $summary = substr(strip_tags($post->content), 0, $length - 3) . "...";
endif;
?>
<article itemscope itemtype="http://schema.org/CreativeWork">
  <div class="teaser teaser-zoom teaser-large">
    <a href="/blog/<?= $post->id ?>" title="Visualizza">
      <img src="<?= $img_url ?>" alt="<?= $post->title ?>" class="img-responsive img-thumbnail" itemprop="image">
    </a>
    <div class="teaser-info">
      <h3 itemprop="name"><?= $post->title ?></h3>
      <div class="teaser-showup">
        <p itemprop="text"><?= $summary ?></p>
        <p class="text-right">
          <span class="hidden">Pubblicato il <time itemprop="datePublished"><?= $post->created_at ?></time></span>
          <a href="/blog/<?= $post->id ?>" title="Visualizza" class="btn btn-primary">Visualizza <span class="glyphicon glyphicon-eye-open"></span></a>
        </p>
      </div>
    </div>
  </div>
</article>

