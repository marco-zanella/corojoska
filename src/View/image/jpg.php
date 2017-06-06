<?php
header('Content-Type: image/jpeg');
header('Content-Disposition: attachment; filename="' . $name . '.jpg"');

$image->jpeg(null, 90);
