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
            <p>Inserire un paio di righe riguardo a questa pagina</p>
            <dl class="dl-horizontal">
              <dt>Sito Web</dt>
              <dd><a href="http://corojoska.altervista.org">www.corojoska.altervista.org</a></dd>

              <dt>eMail:</dt>
              <dd><a href="mailto:corojoska@live.it">corojoska@live.it</a></dd>

              <dt>Facebook</dt>
              <dd><a href="http://www.facebook.com/pages/Coro-della-Joska/220271187993095" target="_blank">www.facebook.com/pages/Coro-della-Joska/220271187993095</a></dd>

              <dt>YouTube</dt>
              <dd><a href="http://www.youtube.com/user/Corojoska" target="_blank">www.youtube.com/user/Corojoska</a></dd>

              <dt>Il Liceo</dt>
              <dd><a href="http://www.liceopaleocapa.gov.it" target="_blank">www.liceopaleocapa.gov.it</a></dd>
            </dl>

            <h3>Canta con noi!</h3>
            <p>Testo da scrivere</p>

            <h3>Dove siamo</h3>
            <p>Il gruppo si ritrova ogni sabato durante il periodo scolastico nell&rsquo;<a href="/biografia" title="Biografia e sede">auditorium del Liceo Scientifico P. Paleocapa</a> (Via Alcide de Gasperi 19) dalle 13:30 alle 14:30.</p>
            <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyD3RSIWLpNs7iPZmYzLd-2VPq8TPAIvvPA'></script><div class="center-block" style='overflow:hidden;height:400px;width:520px;'><div id='gmap_canvas' style='height:400px;width:520px;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div> <a href='http://maps-generator.com/it'>http://maps-generator.com/it</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=ad73a8c83deb8f477a53cf89be119357ffbcbdb7'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:17,center:new google.maps.LatLng(45.0817,11.7952),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(45.0817,11.7952)});infowindow = new google.maps.InfoWindow({content:'<strong>Sede del Coro della Joska</strong><br>Auditorium Liceo Scientifico P. Paleocapa<br>via Alcide de Gasperi 19<br>45100 Rovigo RO Italia<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
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

