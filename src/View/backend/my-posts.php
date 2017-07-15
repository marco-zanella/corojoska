<?php
$page_info = [
  'title' => "I miei Articoli",
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => null,
  'description' => "Coro giovanile di ispirazione popolare della città di Rovigo che trae il proprio nome dal canto \"Joska, la Rossa!\"."
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

      <div class="row">
        <aside class="col-sm-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-sm-9">
          <p>Da questa pagina è possibile pubblicare nuovi articoli e modificare o cancellare quelli pubblicati. Ogni utente può modificare e cancellare unicamente i propri articoli, ad eccezione dei moderatori che hanno accesso completo agli articoli pubblicati.</p>
          <p>Per pubblicare un nuovo articolo compila il modulo e conferma con il pulsante "Pubblica Articolo". Per modificare o cancellare un articolo pubblicato, usa i pulsanti "Modifica" <span class="glyphicon glyphicon-pencil"></span> o "Elimina" <span class="glyphicon glyphicon-trash"></span> nella riga della tabella corrispondente all'articolo. La cancellazione è irreversibile!</p>

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
