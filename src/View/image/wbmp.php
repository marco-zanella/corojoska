<?php
header('Content-Type: image/vnd.wap.wbmp');
header('Content-Disposition: attachment; filename="' . $name . '.wbmp"');

$image->wbmp();
