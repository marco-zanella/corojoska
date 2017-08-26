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
          <a href="/"><span class="glyphicon glyphicon-home hidden-sm"></span> Homepage</a>
        </li>
        <li<?= $active('calendario') ?>>
          <a href="/calendario"><span class="glyphicon glyphicon-calendar hidden-sm"></span> Calendario</a>
        </li>
        <li<?= $active('biografia') ?>>
          <a href="/biografia"><span class="glyphicon glyphicon-info-sign hidden-sm"></span> Biografia</a>
        </li>
        <li<?= $active('contatti') ?>>
          <a href="/contatti"><span class="glyphicon glyphicon-envelope hidden-sm"></span> Contatti</a>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <?php if (\Joska\Session::isAuthenticated()): ?>
        <li>
          <a href="/account"><span class="glyphicon glyphicon-user hidden-sm"></span> Area Riservata</a>
        </li>
        <?php else: ?>
        <li<?= $active('accedi') ?>>
          <a href="/login"><span class="glyphicon glyphicon-log-in hidden-sm"></span> Accedi</a>
        </li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>
