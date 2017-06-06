<?php
header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="' . $name . '.png"');

$image->png();
