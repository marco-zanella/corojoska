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
    Hello world
    <?php foreach ($posts as $post): ?>
    <?php $this->view('widgets/post-teaser', ['post' => $post]); ?>
    <?php endforeach; ?>

    <?php $this->view('scripts'); ?>
  </body>
</html>
