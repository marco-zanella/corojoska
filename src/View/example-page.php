<?php
$page_info = [
  'title' => 'My Sample Page',
  'description' => 'This is an example page, use it as your template to develop beautiful things'
];
?>
<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', $page_info); ?>
  </head>

  <body>
    <h1>Hello world</h1>
    <p>This is my sample page.</p>


    <?php $this->view('scripts'); ?>
  </body>
</html>
