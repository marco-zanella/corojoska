<?php
$page_info = [
  'title' => "Contatti e Link",
  'section' => 'contatti',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => null,
  'description' => "Pagina che raccoglie le iformazioni su come contattare il Coro della Joska e ne riporta i collegamenti.",
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
            <h2>Contatti e Link</h2>
            <p>Per qualunque informazione o richiesta di contatto puoi utilizzare il nostro indirizzo email <a href="mailto:corojoska@live.it" title="Scrivi un'email">corojoska@live.it</a>, oppure puoi affidarti ai nostri canali ufficiali:</p>

            <div class="row hidden-xs">
              <div class="col-sm-4 col-lg-3 col-lg-offset-1">
                <a href="/" title="Home page del Coro della Joska"><img src="/public/style/icon-home.svg" alt="Homepage" class="img-responsive center-block contact-icon"></a>
                <p class="text-center">Sito Web</p>
                <p class="text-center">
                  <a href="/" title="Sito web">www.corojoska.altervista.org</a>
                </p>
              </div>

              <div class="col-sm-4 col-lg-3">
                <a href="mailto:corojoska@live.it" title="Scrivi un'email"><img src="/public/style/icon-email.svg" alt="Email" class="img-responsive center-block contact-icon"></a>
                <p class="text-center">Indirizzo eMail</p>
                <p class="text-center">
                  <a href="mailto:corojoska@live.it" title="Scrivi un'email">corojoska@live.it</a>
                </p>
              </div>

              <div class="col-sm-4 col-lg-3">
                <a href="http://www.facebook.com/pages/Coro-della-Joska/220271187993095" title="Pagina Facebook"><img src="/public/style/icon-facebook.svg" alt="Facebook" class="img-responsive center-block contact-icon"></a>
                <p class="text-center">Pagina Facebook</p>
                <p class="text-center">
                  <a href="http://www.facebook.com/pages/Coro-della-Joska/220271187993095" title="Pagina Facebook">www.facebook.com/pages/Coro-della-Joska/220271187993095</a>
                </p>
              </div>

              <div class="col-sm-4 col-lg-3 col-lg-offset-1">
                <a href="http://www.youtube.com/user/Corojoska" title="Canale Youtube"><img src="/public/style/icon-youtube.svg" alt="Youtube" class="img-responsive center-block contact-icon"></a>
                <p class="text-center">Canale Youtube</p>
                <p class="text-center">
                  <a href="http://www.youtube.com/user/Corojoska" title="Canale Youtube">www.youtube.com/user/Corojoska</a>
                </p>
              </div>

              <div class="col-sm-4 col-lg-3">
                <a href="http://www.liceopaleocapa.gov.it" title="Sito web del liceo"><img src="/public/style/icon-map.svg" alt="Liceo" class="img-responsive center-block contact-icon"></a>
                <p class="text-center">Sito web del liceo</p>
                <p class="text-center">
                  <a href="http://www.liceopaleocapa.gov.it" title="Sito web del liceo">www.liceopaleocapa.gov.it</a>
                </p>
              </div>
            </div>


            <div class="visible-xs-block">
              <div class="media well">
                <div class="media-left media-middle">
                  <a href="/" title="Home page del Coro della Joska">
                    <img class="media-object contact-icon" src="/public/style/icon-home.svg" alt="Homepage">
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading">Sito web</h4>
                  <a href="/" title="Sito web">www.corojoska.altervista.org</a>
                </div>
              </div>

              <div class="media well">
                <div class="media-body">
                  <h4 class="media-heading">Indirizzo eMail</h4>
                  <a href="mailto:corojoska@live.it" title="Scrivi un'email">corojoska@live.it</a>
                </div>
                <div class="media-right media-middle">
                  <a href="mailto:corojoska@live.it" title="Scrivi un'email">
                    <img class="media-object contact-icon" src="/public/style/icon-email.svg" alt="Email">
                  </a>
                </div>
              </div>

              <div class="media well">
                <div class="media-left media-middle">
                  <a href="http://www.facebook.com/pages/Coro-della-Joska/220271187993095" title="Pagina Facebook">
                    <img class="media-object contact-icon" src="/public/style/icon-facebook.svg" alt="Facebook">
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading">Pagina Facebook</h4>
                  <a href="http://www.facebook.com/pages/Coro-della-Joska/220271187993095" title="Sito web">www.facebook.com/pages/Coro-della-Joska/220271187993095</a>
                </div>
              </div>

              <div class="media well">
                <div class="media-body">
                  <h4 class="media-heading">Canale Youtube</h4>
                  <a href="http://www.youtube.com/user/Corojoska" title="Canale Youtube">www.youtube.com/user/Corojoska</a>
                </div>
                <div class="media-right media-middle">
                  <a href="http://www.youtube.com/user/Corojoska" title="Canale Youtube">
                    <img class="media-object contact-icon" src="/public/style/icon-youtube.svg" alt="Youtube">
                  </a>
                </div>
              </div>

              <div class="media well">
                <div class="media-left media-middle">
                  <a href="http://www.liceopaleocapa.gov.it" title="Sito web del liceo">
                    <img class="media-object contact-icon" src="/public/style/icon-map.svg" alt="Liceo">
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading">Sito web del liceo</h4>
                  <a href="http://www.liceopaleocapa.gov.it" title="Sito web">www.liceopaleocapa.gov.it</a>
                </div>
              </div>
            </div>

            <h3>Canta con noi!</h3>
            <p>Hai mai pensato di cominciare a cantare? Ti incuriosiscono i canti tradizionali e d'autore? Vieni a trovarci nella nostra sede nell'auditorium del Liceo Scientifico P. Paleocapa di Rovigo ogni sabato alle 13.30 durante il periodo scolastico, o scrivici un'email all'indirizzo <a href="mailto:corojoska@live.it" title="Scrivi un'email">corojoska@live.it</a>!</p>
            <p>Accogliamo con piacere chiunque condivida il piacere di cantare, anche senza esperienza o conoscenze musicali.</p>

            <h3>Dove siamo</h3>
            <p>Il gruppo si ritrova ogni sabato durante il periodo scolastico nell&rsquo;<a href="/biografia" title="Biografia e sede">auditorium del Liceo Scientifico P. Paleocapa</a> (Via Alcide de Gasperi 19) dalle 13:30 alle 14:30.</p>
            <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyD3RSIWLpNs7iPZmYzLd-2VPq8TPAIvvPA'></script>
            <div class="center-block img-thumbnail img-responsive" style='overflow:hidden;'>
              <div id='gmap_canvas' style='height:400px;'></div>
              <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
            </div>
            <a href='http://maps-generator.com/it'>http://maps-generator.com/it</a>
            <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=ad73a8c83deb8f477a53cf89be119357ffbcbdb7'></script>
            <script type='text/javascript'>function init_map(){var myOptions = {zoom:17,center:new google.maps.LatLng(45.0817,11.7952),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(45.0817,11.7952)});infowindow = new google.maps.InfoWindow({content:'<strong>Sede del Coro della Joska</strong><br>Auditorium Liceo Scientifico P. Paleocapa<br>via Alcide de Gasperi 19<br>45100 Rovigo RO Italia<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
            <p>Le prove sono aperte al pubblico: vieni a trovarci, ti aspettiamo!</p>
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

