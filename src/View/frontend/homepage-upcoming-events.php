<h2>Prossimi eventi in programma</h2>
<?php foreach ($upcoming_events as $_event): ?>
<?php $this->view('widgets/event-teaser-large', ['event' => $_event]); ?>
<?php endforeach; ?>
