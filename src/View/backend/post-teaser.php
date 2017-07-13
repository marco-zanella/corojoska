<article style="
  position: relative;
">
  <img src="/image/<?php echo urlencode(str_replace("/", "|", $post->image)); ?>/300/150" alt="<?php echo $post->title; ?>" class="img-responsive">
  <div style="
    position: absolute;
    background: rgba(0, 0, 0, 0.6);
    color: white;
    bottom: 10px;
    left: 0;
    width: 100%;
    padding: 0.1em 0.5em;
  ">
    <h4><?php echo $post->title; ?></h4>
  </div>
</article>
