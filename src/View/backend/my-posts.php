<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', ['title' => 'I miei articoli', 'description' => 'Pagina di gestione degli articoli.']); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1>I miei Articoli</h1>
      </div>

      <div class="row">
        <aside class="col-md-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-md-9">
          <p>Qui...</p>


          <section>
            <h2>Inserimento di un nuovo articolo</h2>
            <?php $this->view('backend/post-create'); ?>
          </section>

          <section>
            <h2>Articoli inseriti</h2>
            <table class="table table-striped table-hover table-condensed">
              <thead>
                <th>Titolo</th>
                <th>Pubblicato il</th>
                <th>Azioni</th>
              </thead>
              
              <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                  <td><?php echo $post->title; ?></td>
                  <td><?php echo $post->created_at; ?></td>
                  <td>
                    <form action="/my-posts/<?php echo $post->id; ?>" method="POST">
                      <input type="hidden" name="_method" value="DELETE">
                      <div class="btn-group btn-group-sm">
                        <a href="/blog/<?php echo $post->id; ?>" class="btn btn-default" role="button" title="Visualizza"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <a href="/my-posts/<?php echo $post->id; ?>/edit" class="btn btn-default" role="button" title="Modifica"><span class="glyphicon glyphicon-pencil"></span></a>
                        <button class="btn btn-danger" role="button" title="Elimina"><span class="glyphicon glyphicon-trash"></span></button>
                      </div>
                    </form>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>










            <div class="row">
              <?php foreach ($posts as $post): ?>
              <div class="col-md-4">
                <div class="thumbnail">
                  <?php $this->view('backend/post-teaser', ['post' => $post]); ?>
                  <div class="caption text-right">
                    <div class="btn-group btn-group-sm" role="group">
                      <button type="button" class="btn btn-default">Left</button>
                      <button type="button" class="btn btn-default">Middle</button>
                      <button type="button" class="btn btn-default">Right</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </section>
        </div>
      </div>
    </div>

  <?php $this->view('scripts'); ?>
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('content');
  </script>
  </body>
</html>
