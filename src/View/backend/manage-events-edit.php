<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', ['title' => 'Modifica evento', 'description' => 'Pagina di modifica di un evento.']); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1>Modifica Evento</h1>
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
