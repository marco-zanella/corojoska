<?php
$page_info = [
  'title' => "Repertorio",
  'section' => 'repertorio',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => null,
  'description' => "Pagina dedicata al repertorio del Coro della Joska del Liceo Scientifico Statale P. Paleocapa di Rovigo.."
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
        <div class="col-md-8 col-lg-9">
          <section>
            <h2>Repertorio</h2>
            <p>Questa pagina non ha nessun contenuto</p>
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

