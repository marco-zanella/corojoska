<?php
header('Content-Type: image/jpeg');
header('Content-Disposition: attachment; filename="prova.jpg"');

$image->jpeg(null, 90);
