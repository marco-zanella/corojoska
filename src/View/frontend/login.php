<?php
$page_info = [
  'title' => "Accedi",
  'section' => 'accedi',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => null,
  'description' => "Permette l'accesso all'area riservata del sito web del Coro della Joska agli utenti amministratori.",
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

    <div class="container background-white">
      <div class="row">
        <!-- Main content -->
        <div class="col-md-8 col-lg-9">
          <section>
            <h2>Accedi</h2>
            <form action="/login" method="POST">
              <div class="form-group">
                <label for="inputUsername">Nome Utente</label>
                <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Nome Utente" required>
              </div>

              <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
              </div>

              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
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
