<?php header("HTTP/1.0 404 Not Found"); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', ['title' => '404 - File Not Found', 'description' => 'Risorsa non trovata.']); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1>Risorsa non Trovata</h1>
      </div>

      <div class="row">
        <aside class="col-sm-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-sm-9">
        <h2>Errore 404 - Risorsa non Trovata</h2>
        <p>La risorsa, pagina o contenuto a cui stai cercando di accedere non è disponibile o non esiste più. Controlla che l'URL inserito sia corretto.</p>
        </div>
      </div>
    </div>

    <?php $this->view('scripts'); ?>
  </body>
</html>
