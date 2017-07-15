<?php
$page_info = [
  'title' => "Home Page",
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => null,
  'description' => "Coro giovanile di ispirazione popolare della città di Rovigo che trae il proprio nome dal canto \"Joska, la Rossa!\"."
];
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php $this->view('head', $page_info); ?>
    <?php $this->view('frontend/head'); ?>
  </head>

  <body>
    <!-- Page header -->
    <header class="header-image">
      <?php $this->view('frontend/header'); ?>
    </header>

    <div class="container background-white">
      <div class="row">
        <!-- Main content -->
        <div class="col-md-8 col-lg-9">
          <?php if(!empty($upcoming_events)): ?>
          <section>
            <?php $this->view('frontend/homepage-upcoming-events', ['upcoming_events' => $upcoming_events]); ?>
          </section>
          <?php endif; ?>

          <section>
            <?php $this->view('frontend/homepage-latest-posts', ['posts' => $posts]); ?>
          </section>
        </div>

        <!-- Aside and various widgets -->
        <aside class="col-md-4 col-lg-3">
          <?php $this->view('frontend/aside', $_variables); ?>
        </aside>
      </div>
    </div>


    <!-- Footer -->
    <footer>
      <?php $this->view('frontend/footer'); ?>
    </footer>

    <?php $this->view('scripts'); ?>
  </body>
</html>
