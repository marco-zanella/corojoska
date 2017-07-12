<?php
header('Content-Type: image/gif');
header('Content-Disposition: inline; filename="' . $name . '.gif"');

$image->gif();
?>
