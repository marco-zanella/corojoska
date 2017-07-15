<?php
$active = function ($name) use($section) {
  return $name == $section ? ' class="active"' : '';
}
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Coro della Joska</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li<?= $active('home') ?>>
          <a href="/">Homepage <span class="glyphicon glyphicon-home hidden-sm"></span></a>
        </li>
        <li<?= $active('calendario') ?>>
          <a href="/calendario">Calendario <span class="glyphicon glyphicon-calendar hidden-sm"></span></a>
        </li>
        <li<?= $active('biografia') ?>>
          <a href="/biografia">Biografia <span class="glyphicon glyphicon-info-sign hidden-sm"></span></a>
        </li>
        <li<?= $active('repertorio') ?>>
          <a href="/repertorio">Repertorio <span class="glyphicon glyphicon-music hidden-sm"></span></a>
        </li>
        <li<?= $active('contatti') ?>>
          <a href="/contatti">Contatti <span class="glyphicon glyphicon-envelope hidden-sm"></span></a>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <?php if (\Joska\Session::isAuthenticated()): ?>
        <li>
          <a href="/account">Area Riservata <span class="glyphicon glyphicon-user hidden-sm"></span></a>
        </li>
        <?php else: ?>
        <li<?= $active('accedi') ?>>
          <a href="/login">Accedi <span class="glyphicon glyphicon-log-in hidden-sm"></span></a>
        </li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>
