<?php
$page_info = [
  'title' => "Modifica Evento: " . $event->name,
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => null,
  'description' => "Pagina dedicata alla modifica dell'evento $event->name."
];
?>
<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', $page_info); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1><?= $page_info['title'] ?></h1>
      </div>

      <ul class="breadcrumb">
        <li><a href="/manage-events">Gestione Eventi</a></li>
        <li><?php echo $event->name; ?></li>
        <li class="active">Modifica</li>
      </ul>

      <div class="row">
        <aside class="col-sm-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-sm-9">
          <?php $this->view('backend/event-edit', ['event' => $event]); ?>
        </div>
      </div>
    </div>

  <?php $this->view('scripts'); ?>
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('event_description');
  </script>
  </body>
</html>
