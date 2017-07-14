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

      <ol class="breadcrumb">
        <li><a href="/account">Account Personale</a></li>
        <li class="active">Modifica Informazioni</li>
      </ol>

      <div class="row">
        <aside class="col-sm-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-sm-9">
          <section>

            <h2>Modifica Informazioni Account</h2>
            <p>Da questa pagina è possibile modificare le informazioni associate al proprio account personale. Alcune informazioni, come il nome utente, non sono modificabili.</p>
            <p><strong>Modifica della password:</strong> Per modificare la password, compilare i campi "password" e "conferma" password. Lasciandoli vuoti, la password non verrà modificata.</p>

            <form action="/account" method="POST" class="form-horizontal">
              <input type="hidden" name="_method" value="PUT">

              <div class="form-group">
                <label for="inputUsername" class="col-sm-2 control-label">Nome Utente</label>
                <div class="col-sm-10">
                  <input type="text" name="username" value="<?php echo $user->username; ?>" class="form-control" id="inputUsername" placeholder="Nome Utente" readonly>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">Nuova Password</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Nuova Password (lasciare vuoto per non modificarla)">
                </div>
              </div>

              <div class="form-group">
                <label for="inputPasswordConfirm" class="col-sm-2 control-label">Conferma Password</label>
                <div class="col-sm-10">
                  <input type="password" name="password-confirm" class="form-control" id="inputPasswordConfirm" placeholder="Conferma Password">
                </div>
              </div>

              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Nome</label>
                <div class="col-sm-10">
                  <input type="text" name="name" value="<?php echo $user->name; ?>" class="form-control" id="inputName" placeholder="Nome" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputSurname" class="col-sm-2 control-label">Cognome</label>
                <div class="col-sm-10">
                  <input type="text" name="surname" value="<?php echo $user->surname; ?>" class="form-control" id="inputSurname" placeholder="Cognome" required>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-block">Applica Modifiche</button>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

    <?php $this->view('scripts'); ?>
  </body>
</html>
