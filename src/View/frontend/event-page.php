<?php
$page_info = [
  'title' => $event->name,
  'section' => 'calendario',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => $event->image,
  'description' => $event->getSummary()
];

$breadcrumb = [
  ['Calendario Eventi', '/calendario'],
  $event->name
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
      <?php $this->view('frontend/header'); ?>
    </header>

    <div class="container background-white">
      <div class="row">
        <!-- Main content -->
        <?php $this->view('widgets/breadcrumb', ['pages' => $breadcrumb]); ?>
        <div class="col-md-8 col-lg-9">
          <h2><?= $event->name ?></h2>
          <div class="row">
            <div class="col-sm-4 col-md-5">
              <img src="/<?= $event->image ?>" alt="<?= $event->name ?>" class="img-responsive">
            </div>
            <div class="col-sm-8 col-md-7">
              <p><?= $event->summary ?></p>
              <dl class="dl-horizontal">
                <dt>Luogo:</td>
                <dd><?= $event->place ?></dd>

                <dt>Data:</dt>
                <dd><?= date('d/m/Y, \a\l\l\e H:i', strtotime($event->date)) ?></dd>
              </dl>

              <div><?= $event->description ?></div>
            </div>
          </div>
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

