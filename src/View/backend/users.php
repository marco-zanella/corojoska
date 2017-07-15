<?php
$page_info = [
  'title' => "Gestione Utenti",
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => null,
  'description' => "Pagina dedicata alla gestione degli utenti."
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
        <h1><?= $page_info['title'] ?></h1>
      </div>

      <div class="row">
        <aside class="col-sm-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-sm-9">
          <?php $this->view('widgets/alert'); ?>

          <p>
            Da questa pagina è possibile gestire gli utenti registrati ed aggiungerne di nuovi. Per registrare un nuovo utente, compila il modulo e conferma tramite il pulsante "Aggiungi Utente". Per visualizzare i dati di un utente registrato, modificarne i dati o cancellarne la registrazione, clicca sui pulsanti "visualizza" <span class="glyphicon glyphicon-eye-open"></span>, "modifica" <span class="glyphicon glyphicon-pencil"> o "cancella" <span class="glyphicon glyphicon-trash"> alla riga corrispondente nella tabella utente.
          </p>


          <section>
            <h2>Inserimento di un nuovo utente</h2>
            <form action="/users" method="POST" class="form-horizontal">
              <div class="form-group">
                <label for="inputUsername" class="col-sm-2 control-label">Nome utente</label>
                <div class="col-sm-10">
                  <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Nome utente">
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>
              </div>

              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Nome</label>
                <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="inputName" placeholder="Nome">
                </div>
              </div>

              <div class="form-group">
                <label for="inputSurname" class="col-sm-2 control-label">Cognome</label>
                <div class="col-sm-10">
                  <input type="text" name="surname" class="form-control" id="inputSurname" placeholder="Cognome">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-block">Aggiungi utente</button>
                </div>
              </div>
            </form>
          </section>


          <section>
            <h2>Utenti registrati</h2>
            <table class="table table-striped table-hover table-condensed">
              <thead>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Nome utente</th>
                <th>Azioni</th>
              </thead>
              <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                  <td><?php echo $user->name; ?></td>
                  <td><?php echo $user->surname; ?></td>
                  <td><?php echo $user->username; ?></td>
                  <td>
                    <form action="/users/<?php echo $user->id; ?>" method="POST">
                      <input type="hidden" name="_method" value="DELETE">
                      <div class="btn-group btn-group-sm">
                        <a href="/users/<?php echo $user->id; ?>" class="btn btn-default" role="button" title="Visualizza"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <a href="/users/<?php echo $user->id; ?>/edit" class="btn btn-default" role="button" title="Modifica"><span class="glyphicon glyphicon-pencil"></span></a>
                        <button class="btn btn-danger" role="button" title="Elimina"><span class="glyphicon glyphicon-trash"></span></button>
                      </div>
                    </form>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </section>
        </div>
      </div>
    </div>

    <?php $this->view('scripts'); ?>
  </body>
</html>
