<?php
$permission_ids = [];
foreach ($permissions as $permission):
  $permission_ids[$permission->permission_id] = true;
endforeach;

$permission_entry = function ($id, $display_name = null) use($permission_ids) {
  $checked = isset($permission_ids[$id]) ? 'checked' : '';
  if (empty($display_name)) {
    $display_name = ucwords(str_replace("-", " ", $id));
  }

  return '<input name="permissions[]" value="' . $id . '" type="checkbox" ' . $checked . '> ' . $display_name;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', ['title' => 'Modifica Utente', 'description' => 'Pagina di modifica di un account.']); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1>Modifica Utente</h1>
      </div>

      <ul class="breadcrumb">
        <li><a href="../../users">Gestione Utenti</a></li>
        <li><a href="../<?php echo $user->id; ?>"><?php echo $user->name . ' ' . $user->surname; ?></a></li>
        <li class="active">Modifica</li>
      </ul>

      <div class="row">
        <aside class="col-md-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-md-9">
          <?php $this->view('alert'); ?>

          <section>
            <p>Da questa pagina è possibile modificare le informazioni dell'utente <?php echo $user->name . ' ' . $user->surname; ?>, inclusi i permessi.</p>

            <h2>Modifica Dettagli Account</h2>
            <form action="../<?php echo $user->id; ?>" method="POST" class="form-horizontal">
              <input type="hidden" name="_method" value="PUT">

              <div class="form-group">
                <label for="inputUsername" class="col-sm-2 control-label">Nome Utente</label>
                <div class="col-sm-10">
                  <input type="text" name="username" value="<?php echo $user->username; ?>" class="form-control" id="inputUsername" placeholder="Nome Utente" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password (lasciare vuoto per non modificarla)">
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
                <label for="inputPermissions" class="col-sm-2 control-label">Permessi</label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label><?php echo $permission_entry('publish'); ?></label>
                  </div>

                  <div class="checkbox">
                    <label><?php echo $permission_entry('manage-posts'); ?></label>
                  </div>

                  <div class="checkbox">
                    <label><?php echo $permission_entry('manage-users'); ?></label>
                  </div>
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
