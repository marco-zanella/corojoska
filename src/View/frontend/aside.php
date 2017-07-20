<div class="hidden-sm hidden-xs">
  <a href="/"><img src="/public/style/logo.svg" alt="logo" class="img-responsive img-thumbnail center-block"></a>
</div>
<?php $this->view('widgets/upcoming-events', ['upcoming_events' => $upcoming_events]); ?>
<?php $this->view('widgets/latest-posts', ['latest_posts' => $latest_posts]); ?>
