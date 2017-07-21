<?php
header("HTTP/1.0 404 Not Found");

$page_info = [
  'title' => "404 - File Not Found",
  'section' => 'misc',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => "http://{$_SERVER['HTTP_HOST']}/public/style/logo.svg", 
  'description' => "La risorsa cercata non è stata trovata.",
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
            <h2>Pagina non trovata - Errore 404</h2>
            <p>La risorsa o pagina richiesta non è stata trovata o non esiste più.</p>
            <ul>
              <li>Assicurati di aver digitato correttamente l'URL della pagina</li>
              <li>Se l'URL proveniva da un <em>link</em> esterno, probabilmente quest'ultimo è rotto (tutta colpa di chi gestisce la pagina da cui provieni!)</li>
              <li>Niente panico, puoi visitare la nostra <a href="/" title="Homepage">homepage</a> e trovare quello che cerchi</li>
              <li>Perché non fai un salto nella nostra sede? Potresti entrare a far parte del coro!</li>
              <li>Lasciati ispirare! Di seguito troverai una selezione di immagini di repertorio realizzare dal nostro team di australopitechi ubriachi apposta per te!</li>
            </ul>
            <div class="row">
              <div class="col-sm-4">
                <img src="/public/content/404-1.jpg" alt="404-1" class="img-responsive center-block">
              </div>
              <div class="col-sm-4">
                <img src="/public/content/404-2.jpg" alt="404-2" class="img-responsive center-block">
              </div>
              <div class="col-sm-4">
                <img src="/public/content/404-3.jpg" alt="404-3" class="img-responsive center-block">
              </div>
            </div>
            <p>Non dimenticare di consultare il <a href="/calendario" title="Calendario eventi">calendario eventi</a> per non perdere i prossimi eventi in programma.</p>
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

