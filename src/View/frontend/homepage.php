<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', [
      'title' => 'Home page',
      'description' => 'Pagina principale del sito web del Coro della Joska'
    ]); ?>
    <link rel="stylesheet" href="/public/style/teaser.css">
  </head>

  <body>
    <h1>Test Page</h1>
    <p>This will be the homepage. Until then, it will serve as test page.</p>

<div class="container">
<div class="row">
    <?php foreach ($posts as $post): ?>
<div class="col-md-4">
    <?php $this->view('widgets/post-thumbnail', ['post' => $post]); ?>
</div>
    <?php endforeach; ?>
</div>
</div>

    <?php $this->view('scripts'); ?>
  </body>
</html>
