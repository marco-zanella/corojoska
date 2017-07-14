<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', ['title' => 'Gestione Articoli', 'description' => 'Pagina di gestione degli articoli.']); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1>Gestione Articoli</h1>
      </div>

      <div class="row">
        <aside class="col-sm-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-sm-9">
          <p>Da questa pagina è possibile modificare o cancellare gli articoli pubblicati. Per inserire un nuovo articolo, utilizzare la pagina <a href="/my-posts">I miei Articoli</a>. Per modificare o cancellare un articolo, usa i pulsanti "Modifica" <span class="glyphicon glyphicon-pencil"></span> o "Elimina" <span class="glyphicon glyphicon-trash"></span> nella riga della tabella corrispondente all'articolo. La cancellazione è irreversibile!</p>

          <section>
            <h2>Articoli pubblicati</h2>
            <table class="table table-striped table-hover table-condensed">
              <thead>
                <th>Titolo</th>
                <th>Data di pubblicazione</th>
                <th>Azioni</th>
              </thead>
              
              <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                  <td><?php echo $post->title; ?></td>
                  <td><?php echo $post->created_at; ?></td>
                  <td>
                    <form action="/manage-posts/<?php echo $post->id; ?>" method="POST">
                      <input type="hidden" name="_method" value="DELETE">
                      <div class="btn-group btn-group-sm">
                        <a href="/blog/<?php echo $post->id; ?>" class="btn btn-default" role="button" title="Visualizza"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <a href="/manage-posts/<?php echo $post->id; ?>/edit" class="btn btn-default" role="button" title="Modifica"><span class="glyphicon glyphicon-pencil"></span></a>
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
  </body>
</html>
