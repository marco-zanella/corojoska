<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', ['title' => 'Il mio Account', 'description' => 'Pagina di gestione account personale.']); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1>Il mio Account</h1>
      </div>

      <div class="row">
        <aside class="col-md-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-md-9">
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
          </section>
        </div>
      </div>
    </div>

    <?php $this->view('scripts'); ?>
  </body>
</html>
