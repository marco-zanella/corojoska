<?php
header('Content-Type: image/png');
header('Content-Disposition: inline; filename="' . $name . '.png"');

$image->png();
?>
