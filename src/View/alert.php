<div class="alert alert-<?php echo (isset($class) ? $class : 'warning'); ?> alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <?php
  if (isset($content)):
    echo $content;
  else:
  ?>
  <strong>Regola d'oro:</strong> Se non sai cosa stai facendo, non toccare niente!
  <?php endif; ?>
</div>
