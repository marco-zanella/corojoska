<?php if (!empty($latest_posts)): ?>
  <section>
    <h2>Ultimi Articoli</h2>
    <?php foreach ($latest_posts as $_post): ?>
    <?php $this->view('widgets/post-teaser', ['post' => $_post]); ?>
    <?php endforeach; ?>
  </section>
<?php endif; ?>
