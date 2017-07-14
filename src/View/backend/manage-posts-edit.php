<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', ['title' => 'Modifica articolo', 'description' => 'Pagina di modifica di un articolo.']); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1>Modifica Articolo</h1>
      </div>

      <ul class="breadcrumb">
        <li><a href="/manage-posts">Gestione Articoli</a></li>
        <li><?php echo $post->title; ?></li>
        <li class="active">Modifica</li>
      </ul>

      <div class="row">
        <aside class="col-sm-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-sm-9">
          <?php $this->view('backend/post-edit', ['post' => $post, 'target' => '/manage-posts']); ?>
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
