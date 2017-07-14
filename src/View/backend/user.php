<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', ['title' => 'Visualizza Utente', 'description' => 'Pagina di visualizzazione di un account.']); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1>Visualizza Utente</h1>
      </div>

      <ul class="breadcrumb">
        <li><a href="/users">Gestione Utenti</a></li>
        <li class="active"><?php echo $user->name . ' ' . $user->surname; ?></li>
      </ul>

      <div class="row">
        <aside class="col-sm-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-sm-9">
          <section>
            <p>Da questa pagina è possibile visualizzare un riepilogo dell'account personale di <?php echo $user->name . ' ' . $user->surname; ?>, inclusi i permessi. Per modificare le informazioni od i permessi relativi all'account, utilizzare il pulsante "Modifica Informazioni".</p>

            <h2>Dettagli Account</h2>
            <dl class="dl-horizontal">
              <dt>Nome utente</dt>
              <dd><?php echo $user->username; ?></dd>

              <dt>Nome</dt>
              <dd><?php echo $user->name; ?></dd>

              <dt>Cognome</dt>
              <dd><?php echo $user->surname; ?></dd>

              <dt>Permessi</dt>
              <dd>
                <ul>
                  <?php foreach ($permissions as $permission): ?>
                  <li><?php echo ucwords(str_replace("-", " ", $permission->permission_id)); ?>
                  <?php endforeach; ?>
                </ul>
              </dd>
            </dl>

            <a href="/users/<?php echo $user->id; ?>/edit" class="btn btn-primary btn-block" role="button">Modifica Informazioni</a>
          </section>
        </div>
      </div>
    </div>

    <?php $this->view('scripts'); ?>
  </body>
</html>
