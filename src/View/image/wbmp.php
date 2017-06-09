<?php
header('Content-Type: image/vnd.wap.wbmp');
header('Content-Disposition: inline; filename="' . $name . '.wbmp"');

$image->wbmp();
?>
