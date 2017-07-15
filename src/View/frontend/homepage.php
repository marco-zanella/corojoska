<?php
$page_info = [
  'title' => "Home Page",
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => null,
  'description' => "Coro giovanile di ispirazione popolare della città di Rovigo che trae il proprio nome dal canto \"Joska, la Rossa!\"."
];

$breadcrumb = [
  ['Home Page', '/home'],
  'Here'
];
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php $this->view('head', $page_info); ?>
    <link rel="stylesheet" href="/public/style/frontend.css">
    <link rel="stylesheet" href="/public/style/teaser.css">
  </head>

  <body>
    <!-- Page header -->
    <header class="header-image" style="background-image: url('http://www.mrwallpaper.com/wallpapers/deep-space.jpg');">
      <div class="container">
        <div class="page-header header-bottom">
          <h1>Coro della Joska</h1>
        </div>
      </div>
    </header>


    <div class="container background-white">
      <div class="row">
        <!-- Breadcrumb -->
        <?php $this->view('widgets/breadcrumb', ['pages' => $breadcrumb]); ?>

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
          <?php $this->view('widgets/upcoming-events', ['upcoming_events' => $upcoming_events]); ?>
          <?php $this->view('widgets/latest-posts', ['latest_posts' => $latest_posts]); ?>
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
