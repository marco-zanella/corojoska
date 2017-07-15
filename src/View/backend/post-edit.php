<?php
$action = (isset($target) ? $target : '/my-posts') . '/' . $post->id . '/edit';
?>
<form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="_method" value="PUT">

  <div class="form-group">
    <label for="inputTitle">Titolo</label>
    <input type="text" name="title" value="<?php echo $post->title; ?>" class="form-control" id="inputTitle" placeholder="Titolo dell'articolo" required>
  </div>

  <div class="form-group row">
    <div class="col-sm-7">
      <label for="inputImage">Immagine di testata</label>
      <span id="helpImage" class="help-block">Immagine che verrà mostrata come sfondo alla testata dell'articolo e come anteprima. Per un effetto ottimale usare immagini il cui rapporto aspetto sia 2:1, ad esempio 600x300 o 1000x500.</span>
      <input type="file" name="image" id="inputImage">
    </div>
    <div class="col-sm-5">
      <img src="/image/<?php echo urlencode(str_replace("/", "|", $post->image)); ?>/256/128" alt="Immagine di testata" class="img-responsive">
    </div>
  </div>

  <div class="form-group">
    <label for="inputSummary">Breve descrizione</label>
    <span id="helpSummary" class="help-block">Un breve sommario dell'articolo, di lunghezza compresa tra 50 e 170 parole.</span>
    <textarea name="summary" id="inputSummary" class="form-control" placeholder="Breve descrizione"><?php echo $post->summary ?></textarea>
  </div>

  <div class="form-group">
    <label for="inputContent">Contenuto</label>
    <textarea name="content" id="inputContent" placeholder="Contenuto" required><?php echo $post->content; ?></textarea>
  </div>

  <button type="submit" class="btn btn-primary btn-block">Applica Modifiche</button>
</form>
