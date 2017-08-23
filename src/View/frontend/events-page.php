<?php
$page_info = [
  'title' => "Calendario Eventi",
  'section' => 'calendario',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => "http://{$_SERVER['HTTP_HOST']}/public/style/logo.png",
  'description' => "Calendario eventi e concerti del Coro della Joska, con date e luogi di eventi, concerti e manifestazioni passati e in programma.",
  'show_header_image' => true
];
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php $this->view('head', $page_info); ?>
    <?php $this->view('frontend/head'); ?>
  </head>

  <body>
    <!-- Navbar -->
    <?php $this->view('frontend/navbar', $page_info); ?>

    <!-- Page header -->
    <header class="header-image">
      <?php $this->view('frontend/header', $page_info); ?>
    </header>

    <main class="container">
      <div class="row">
        <!-- Main content -->
        <div class="col-md-8 col-lg-9">
          <section>
            <h2>Eventi in programma</h2>
            <?php foreach ($upcoming_events as $event): ?>
            <?php $this->view('widgets/event-teaser-large', ['event' => $event]); ?>
            <?php endforeach; ?>
            
            <?php if (empty($upcoming_events)): ?>
            <p>Al momento non ci sono eventi in programma.</p>
            <?php endif; ?>
          </section>

          <section>
            <h2>Eventi passati</h2>
            <?php foreach ($past_events as $event): ?>
            <div class="well well-sm">
              <?php $this->view('widgets/event-list-item', ['event' => $event]); ?>
            </div>
            <?php endforeach; ?>
          </section>
        </div>

        <!-- Aside and various widgets -->
        <aside class="col-md-4 col-lg-3">
          <?php $this->view('frontend/aside', $_variables); ?>
        </aside>
      </div>
    </main>


    <!-- Footer -->
    <footer>
      <?php $this->view('frontend/footer'); ?>
    </footer>

    <?php $this->view('scripts'); ?>
  </body>
</html>
