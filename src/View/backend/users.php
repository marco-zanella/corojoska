<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', ['title' => 'Gestione utenti', 'description' => 'Pagina di gestione utenti']); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1>Gestione utenti</h1>
      </div>

      <div class="row">
        <aside class="col-md-3">
        menu
        </aside>

        <div class="col-md-9">
          <?php foreach ($users as $user): ?>
          <article>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <?php $this->view('scripts'); ?>
  </body>
</html>
