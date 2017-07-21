<?php
$page_info = [
  'title' => "Esci",
  'section' => 'accedi',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => "http://{$_SERVER['HTTP_HOST']}/public/style/logo.png",
  'description' => "Permette la disconnessione sicura dall'area riservata del sito web del Coro della Joska per gli utenti amministratori.",
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
            <h2>Esci</h2>
            <p>Sei attualmente autenticato come <?= \Joska\Session::getAuthenticatedUser()->username ?>.</p>
            <form action="/login" method="POST">
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-primary btn-block">Logout</button>
            </form>
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

