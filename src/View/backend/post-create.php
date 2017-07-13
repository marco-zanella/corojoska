<form action="/my-posts" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="inputTitle">Titolo</label>
    <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Titolo dell'articolo" required>
  </div>

  <div class="form-group">
    <label for="inputImage">Immagine di testata</label>
    <input type="file" name="image" id="inputImage">
  </div>

  <div class="form-group">
    <label for="inputContent">Contenuto</label>
    <textarea name="content" id="inputContent" placeholder="Contenuto" required></textarea>
  </div>

  <button type="submit" class="btn btn-primary btn-block">Pubblica Articolo</button>
</form>
