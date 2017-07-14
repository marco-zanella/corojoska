<?php if (!empty($upcoming_events)): ?>
<section>
  <h2>Prossimi Eventi</h2>
  <?php foreach ($upcoming_events as $_event): ?>
  <?php $this->view('widgets/event-teaser', ['event' => $_event]); ?>
  <?php endforeach; ?>
</section>
<?php endif; ?>
