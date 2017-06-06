<?php
header('Content-Type: image/gif');
header('Content-Disposition: attachment; filename="' . $name . '.gif"');

$image->gif();
