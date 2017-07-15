<div class="hidden-xs">
  <div class="panel panel-primary">
    <div class="panel-heading">
      Pannello di Controllo
    </div>
  
    <div class="list-group">
      <a href="/" class="list-group-item">Torna al sito</a>
      <a href="/account" class="list-group-item">Il mio Account</a>
      <?php if (\Joska\Session::hasPermission('publish')): ?>
      <a href="/my-posts" class="list-group-item">I miei Articoli</a>
      <?php endif; ?>
      <?php if (\Joska\Session::hasPermission('manage-posts')): ?>
      <a href="/manage-posts" class="list-group-item">Gestione Articoli</a>
      <?php endif; ?>
      <?php if (\Joska\Session::hasPermission('manage-events')): ?>
      <a href="/manage-events" class="list-group-item">Gestione Eventi</a>
      <?php endif; ?>
      <?php if (\Joska\Session::hasPermission('manage-users')): ?>
      <a href="/users" class="list-group-item">Gestione Utenti</a>
      <?php endif; ?>
    </div>
  </div>
</div>


<div class="visible-xs-block">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/account">Pannello di Controllo</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="/">Torna al sito</a></li>
          <li><a href="/account">Il mio Account</a></li>
          <?php if (\Joska\Session::hasPermission('publish')): ?>
          <li><a href="/my-posts">I miei Articoli</a></li>
          <?php endif; ?>
          <?php if (\Joska\Session::hasPermission('manage-posts')): ?>
          <li><a href="/manage-posts">Gestione Articoli</a></li>
          <?php endif; ?>
          <?php if (\Joska\Session::hasPermission('manage-events')): ?>
          <li><a href="/manage-events">Gestione Eventi</a></li>
          <?php endif; ?>
          <?php if (\Joska\Session::hasPermission('manage-users')): ?>
          <li><a href="/users">Gestione Utenti</a></li>
          <?php endif; ?>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</div>
