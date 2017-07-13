<form action="/my-posts/<?php echo $post->id; ?>" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="_method" value="PUT">

  <div class="form-group">
    <label for="inputTitle">Titolo</label>
    <input type="text" name="title" value="<?php echo $post->title; ?>" class="form-control" id="inputTitle" placeholder="Titolo dell'articolo" required>
  </div>

  <div class="form-group row">
    <div class="col-sm-5">
      <label for="inputImage">Immagine di testata</label>
      <input type="file" name="image" id="inputImage">
    </div>
    <div class="col-sm-7">
      <img src="/image/<?php echo urlencode(str_replace("/", "|", $post->image)); ?>/256/128" alt="Immagine di testata" class="img-responsive">
    </div>
  </div>

  <div class="form-group">
    <label for="inputContent">Contenuto</label>
    <textarea name="content" id="inputContent" placeholder="Contenuto" required><?php echo $post->content; ?></textarea>
  </div>

  <button type="submit" class="btn btn-primary btn-block">Applica Modifiche</button>
</form>
