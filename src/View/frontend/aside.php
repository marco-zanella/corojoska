<div class="hidden-sm hidden-xs">
  <a href="/" title="Home page del Coro della Joska"><img src="/public/style/logo.png" alt="Coro della Joska - logo" class="img-responsive img-thumbnail center-block"></a>
</div>
<a href="/contatti" title="Canta con noi" class="btn btn-primary btn-lg btn-block">Canta con noi!</a>
<?php $this->view('widgets/search-form', $_variables); ?>
<?php $this->view('widgets/upcoming-events', ['upcoming_events' => $upcoming_events]); ?>
<?php $this->view('widgets/latest-posts', ['latest_posts' => $latest_posts]); ?>
