<?php
$events = (new \Joska\DataMapper\Sql('Event'))->search();
?>
<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', [
      'title' => 'Home page',
      'description' => 'Pagina principale del sito web del Coro della Joska'
    ]); ?>
    <link rel="stylesheet" href="/public/style/teaser.css">

    <style>
      body {
        background: lightblue;
      }
      .background-white {
        background: white;
      }
    </style>
  </head>

  <body>
    <!-- Page header -->
    <header style="
      background-image: url('http://www.mrwallpaper.com/wallpapers/deep-space.jpg');
      background-size: cover;
      background-position: center center;
    ">
      <div class="container">
        <div class="page-header" style="min-height: 300px; position: relative;">
          <h1 style="position: absolute; bottom: 0; color: white; text-shadow: 0 0 1px #000">My Homepage</h1>
        </div>
      </div>
    </header>


    <div class="container background-white">
      <div class="row">
        <!-- Breadcrumb -->
        <ul class="breadcrumb">
          <li><a href="/home">Homepage</a></li>
          <li class="active">here</li>
        </ul>

        <!-- Main content -->
        <div class="col-md-8 col-lg-9">
          <section>
            <h2><?= $posts[0]->title ?></h2>
            <?= $posts[0]->content ?>
          </section>
          <section>
            <h2>Test</h2>
            <?php foreach ($events as $event): ?>
            <?php $this->view('widgets/event-list-item', ['event' => $event]); ?>
            <?php endforeach; ?>
          </section>
        </div>

        <!-- Aside and various widgets -->
        <aside class="col-md-4 col-lg-3">
          <?php $this->view('widgets/upcoming-events', ['upcoming_events' => [$events[0]]]); ?>
          <?php $this->view('widgets/latest-posts', ['latest_posts' => $posts]); ?>
        </aside>
      </div>
    </div>


    <!-- Footer -->
    <footer>
      <div class="container-fluid">
        Footer information
      </div>
    </footer>

    <?php $this->view('scripts'); ?>
  </body>
</html>
