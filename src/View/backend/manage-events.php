<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', ['title' => 'Gestione Eventi', 'description' => 'Pagina di gestione degli eventi.']); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1>Gestione Eventi</h1>
      </div>

      <div class="row">
        <aside class="col-sm-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-sm-9">
          <p>Da questa pagina è possibile pubblicare nuovi eventi e modificare o cancellare quelli esistenti. Per inserire un nuovo evento, compila il modulo e conferma con il pulsante "Inserisci Evento". Per modificare o cancellare un evento, usa i pulsanti "Modifica" <span class="glyphicon glyphicon-pencil"></span> o "Elimina" <span class="glyphicon glyphicon-trash"></span> nella riga della tabella corrispondente all'evento. La cancellazione è irreversibile!</p>

          <section>
            <h2>Inserimento di un nuovo evento</h2>
            <?php $this->view('backend/event-create'); ?>
          </section>

          <section>
            <h2>Eventi inseriti</h2>
            <table class="table table-striped table-hover table-condensed">
              <thead>
                <th>Nome</th>
                <th>Luogo</th>
                <th>Data</th>
                <th>Azioni</th>
              </thead>
              
              <tbody>
                <?php foreach ($events as $event): ?>
                <tr>
                  <td><?php echo $event->name; ?></td>
                  <td><?php echo $event->place; ?></td>
                  <td><?php echo $event->date; ?></td>
                  <td>
                    <form action="/manage-events/<?php echo $event->id; ?>" method="POST">
                      <input type="hidden" name="_method" value="DELETE">
                      <div class="btn-group btn-group-sm">
                        <a href="/calendario/<?php echo $event->id; ?>" class="btn btn-default" role="button" title="Visualizza"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <a href="/manage-events/<?php echo $event->id; ?>/edit" class="btn btn-default" role="button" title="Modifica"><span class="glyphicon glyphicon-pencil"></span></a>
                        <button class="btn btn-danger" role="button" title="Elimina"><span class="glyphicon glyphicon-trash"></span></button>
                      </div>
                    </form>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </section>
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
