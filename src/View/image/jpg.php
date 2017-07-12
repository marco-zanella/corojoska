<?php
header('Content-Type: image/jpeg');
header('Content-Disposition: inline; filename="' . $name . '.jpg"');

$image->jpeg(null, 90);
?>
