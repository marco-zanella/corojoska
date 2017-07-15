<?php
$page_info = [
  'title' => "Il mio Account",
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => null,
  'description' => "Pagina di gestione del proprio account personale."
];
?>
<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', $page_info); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1><?php echo $page_info['title']; ?></h1>
      </div>

      <div class="row">
        <aside class="col-sm-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-sm-9">
          <section>
            <h2>Dettagli Account</h2>
            <p>Da questa pagina è possibile visualizzare un riepilogo del proprio account personale. Per modificare le informazioni del proprio account, utilizzare il pulsante "Modifica Informazioni".</p>

            <dl class="dl-horizontal">
              <dt>Nome utente</dt>
              <dd><?php echo $user->username; ?></dd>

              <dt>Nome</dt>
              <dd><?php echo $user->name; ?></dd>

              <dt>Cognome</dt>
              <dd><?php echo $user->surname; ?></dd>
            </dl>

            <a href="/account/edit" class="btn btn-primary btn-block" role="button">Modifica Informazioni</a>

            <h3>Logout</h3>
            <p>Termina la sessione corrente.</p>
            <form action="/login" method="POST">
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-primary btn-block">Logout</button>
            </form>
          </section>
        </div>
      </div>
    </div>

    <?php $this->view('scripts'); ?>
  </body>
</html>
