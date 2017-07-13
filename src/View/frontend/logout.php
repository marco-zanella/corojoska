<h2>Temporary logout page</h2>
Currently logged as <?php echo \Joska\Session::getAuthenticatedUser()->username; ?>
<form action="/login" method="POST">
  <input type="hidden" name="_method" value="DELETE">
  <button>Logout</button>
</form>
