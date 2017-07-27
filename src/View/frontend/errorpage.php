<?php
$page_info = [
  'title' => "Errore",
  'section' => 'misc',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => "http://{$_SERVER['HTTP_HOST']}/public/style/logo.png", 
  'description' => "Si è verificato un errore",
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
        <div class="col-xs-12">
          <section>
            <h2>Errore</h2>
            <p>Si è verificato un errore durante l'elaborazione della pagina.</p>
            <?php if (isset($message)): ?>
            <p><?= $message ?></p>
            <?php endif; ?>
          </section>
        </div>
      </div>
    </main>


    <!-- Footer -->
    <footer>
      <?php $this->view('frontend/footer'); ?>
    </footer>

    <?php $this->view('scripts'); ?>
  </body>
</html>

