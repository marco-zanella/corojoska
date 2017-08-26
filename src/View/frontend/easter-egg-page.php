<?php
$page_info = [
  'title' => "Easter Egg",
  'section' => '',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => "http://{$_SERVER['HTTP_HOST']}/public/style/logo.png",
  'description' => "Anche il coro della Joska ha i suoi easter egg!",
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
            <h2>Guarda qui</h2>
            <p>Se vuoi saperne di più su questi meme e riderne vienici a trovare ogni sabato alle 13:30. Per sapere dove guarda la voce <a href="/contatti" title="Visualizza la pagina dei contatti">Contatti</a> del nostro sito.</p>
            
            <div class="row">
              <div class="col-sm-4">
                <img src="/public/content/easter-egg-1.jpg" alt="Colpo d'ala" class="img-responsive center-block">
              </div>
              <div class="col-sm-4">
                <img src="/public/content/easter-egg-2.jpg" alt="Ora troppo breve" class="img-responsive center-block">
              </div>
              <div class="col-sm-4">
                <img src="/public/content/easter-egg-3.jpg" alt="Legna!" class="img-responsive center-block">
              </div>
            </div>
            
            <p>Se vuoi saperne di più su questi meme e riderne vienici a trovare ogni sabato alle 13:30. Per sapere dove guarda la voce <a href="/contatti" title="Visualizza la pagina dei contatti">Contatti</a> del nostro sito.</p>
            
            <h3>E questo cos'è?</h3>
            <audio autoplay="autoplay" controls="controls" loop="loop">              
              <source src="/public/content/me-compare-giacometo.ogg" type="audio/ogg">
              <source src="/public/content/me-compare-giacometo.mp3" type="audio/mpeg">
              Peccato che il tuo browser non supporti l'audio...
            </audio>
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
