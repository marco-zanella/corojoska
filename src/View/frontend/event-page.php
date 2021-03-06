<?php
$page_info = [
  'title' => $event->name,
  'section' => 'calendario',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => "http://{$_SERVER['HTTP_HOST']}/" . $event->image,
  'description' => $event->getSummary(),
  'show_header_image' => false
];

$breadcrumb = [
  ['Calendario Eventi', '/calendario'],
  $event->name
];

$bg_image = '';
if (!empty($event->image)):
  $bg_image = ' style="background-image: url(/' . $event->image .');"';
endif;
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
    <header class="header-image"<?= $bg_image ?>>
      <?php $this->view('frontend/header', $page_info); ?>
    </header>

    <main class="container">
      <div class="row">
        <!-- Main content -->
        <?php $this->view('widgets/breadcrumb', ['pages' => $breadcrumb]); ?>
        <div class="col-md-8 col-lg-9">
          <h2><?= $event->name ?></h2>
          <div class="row">
            <div class="col-sm-4 col-md-5">
              <?php if (!empty($event->image)): ?>
              <img src="/<?= $event->image ?>" alt="<?= $event->name ?>" class="img-responsive">
              <?php endif; ?>
            </div>
            <div class="col-sm-8 col-md-7">
              <p><?= $event->summary ?></p>
              <dl class="dl-horizontal">
                <dt>Luogo:</dt>
                <dd><?= $event->place ?></dd>

                <dt>Data:</dt>
                <dd><?= date('d/m/Y, \a\l\l\e H:i', strtotime($event->date)) ?></dd>
              </dl>

              <h3>Descrizione</h3>
              <div><?= $event->description ?></div>
            </div>
          </div>
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

