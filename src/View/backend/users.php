<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', ['title' => 'Gestione utenti', 'description' => 'Pagina di gestione utenti']); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1>Gestione utenti</h1>
      </div>

      <div class="row">
        <aside class="col-md-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-md-9">
          <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Regola d'oro:</strong> Se non sai cosa stai facendo, non toccare niente!
          </div>

          <p>
            Da qui puoi gestire gli utenti...
          </p>


          <section>
            <h2>Inserimento di un nuovo utente</h2>
            <form action="users" method="POST" class="form-horizontal">
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
                    <form action="users/<?php echo $user->id; ?>" method="POST">
                      <input type="hidden" name="_method" value="DELETE">
                      <div class="btn-group btn-group-sm">
                        <a href="users/<?php echo $user->id; ?>" class="btn btn-default" role="button" title="Visualizza"><span class="glyphicon glyphicon-eye-open"></span></a>
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
