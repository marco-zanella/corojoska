<!DOCTYPE HTML>
<html>
  <head>
    <title>Test page</title>
  </head>

  <body>
    <h1>Hello, world!</h1>
    <p>Page content.</p>


    <h2>Injected variables</h2>
    <pre><?php var_dump($_variables); ?></pre>


    <h2>Include another view</h2>
    <?php $this->view('test/subview'); ?>
  </body>
</html>
