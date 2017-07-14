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

<?php
$events = (new \Joska\DataMapper\Sql('Event'))->search();
?>
    <?php foreach ($events as $event): ?>
    <?php $this->view('widgets/event-list-item', ['event' => $event]); ?>
    <?php endforeach; ?>

    <?php $this->view('scripts'); ?>
  </body>
</html>
