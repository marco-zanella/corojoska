<?php if (!empty($latest_posts)): ?>
  <section>
    <h2>Ultimi Articoli</h2>
    <?php foreach ($latest_posts as $_post): ?>
    <div class="hidden-xs hidden-sm">
      <?php $this->view('widgets/post-teaser', ['post' => $_post]); ?>
    </div>
    <div class="visible-xs-block visible-sm-block well well-sm">
      <?php $this->view('widgets/post-list-item', ['post' => $_post]); ?>
    </div>
    <?php endforeach; ?>
  </section>
<?php endif; ?>
