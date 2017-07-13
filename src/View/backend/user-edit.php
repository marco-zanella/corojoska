<h2>Temporary user edit page</h2>
<form action="../../users/<?= $user->id ?>" method="POST">
  <input type="hidden" name="_method" value="PUT">
  <input type="text" name="username" value="<?= $user->username ?>">
  <input type="password" name="password" placeholder="New password (leave empty to keep current one)">
  <input type="text" name="name" value="<?= $user->name ?>">
  <input type="text" name="surname" value="<?= $user->surname ?>">
  <button>Salva modifiche</button>
</form>
