<h2>Ultimi Articoli</h2>
<?php
if (!empty($posts)):
  $this->view('widgets/post-teaser-large', ['post' => $posts[0]]);
endif;
?>

<div class="row">
  <?php if (isset($posts[1])): ?>
  <div class="col-sm-6">
    <?php $this->view('widgets/post-thumbnail', ['post' => $posts[1]]); ?>
  </div>
  <?php endif; ?>

  <?php if (isset($posts[2])): ?>
  <div class="col-sm-6">
    <?php $this->view('widgets/post-thumbnail', ['post' => $posts[2]]); ?>
  </div>
  <?php endif; ?>
</div>

<?php for ($i = 3; $i < count($posts); ++$i): ?>
<div class="panel panel-default">
  <div class="panel-body">
    <?php $this->view('widgets/post-list-item', ['post' => $posts[$i]]); ?>
  </div>
</div>
<?php endfor; ?>

<p>
  <a href="/blog" title="Visualizza tutti gli articoli" class="btn btn-default btn-block">Visualizza tutti gli articoli</a>
</p>
