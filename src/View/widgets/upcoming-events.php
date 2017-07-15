<?php if (!empty($upcoming_events)): ?>
<section>
  <h2>Prossimi Eventi</h2>
  <?php foreach ($upcoming_events as $_event): ?>
  <div class="hidden-xs hidden-sm">
    <?php $this->view('widgets/event-teaser', ['event' => $_event]); ?>
  </div>
  <div class="visible-xs-block visible-sm-block well well-sm">
    <?php $this->view('widgets/event-list-item', ['event' => $_event]); ?>
  </div>
  <?php endforeach; ?>
</section>
<?php endif; ?>
