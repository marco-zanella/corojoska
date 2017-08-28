<?php
$page_info = [
  'title' => "Ricerca",
  'section' => 'ricerca',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => "http://{$_SERVER['HTTP_HOST']}/public/style/logo.png",
  'description' => "Cerca articoli ed eventi pubblicati sul sito del Coro della Joska.",
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
            <?php $this->view('widgets/search-form', $_variables); ?>
            
            <!-- Result -->
            <?php if (isset($query)): ?>
              <h3>
                Risultati ricerca per "<?= $query ?>"
                <small> - <?= count($result) ?> risultati (<?= sprintf("%.2f", $query_time) ?> secondi)
              </h3>
            
              <?php foreach ($result as $item): ?>
              <div class="well well-sm">
                <?php
                if ($item instanceof \Joska\Model\Post):
                  $this->view('widgets/post-list-item', ['post' => $item]);
                elseif ($item instanceof \Joska\Model\Event):
                  $this->view('widgets/event-list-item', ['event' => $item]);
                endif;
                ?>
              </div>
              <?php endforeach; ?>
            
              <?php if (empty($result)): ?>
              <p>La ricerca non ha prodotto risultati</p>
              <?php endif; ?>
            
            <?php else: ?>
              <p>Digita i termini da cercare nella barra di ricerca.</p>
            <?php endif; ?>
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
