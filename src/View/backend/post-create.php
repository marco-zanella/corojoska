<form action="/my-posts" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="inputTitle">Titolo</label>
    <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Titolo dell'articolo" required>
  </div>

  <div class="form-group">
    <label for="inputImage">Immagine di testata</label>
    <span id="helpImage" class="help-block">Immagine che verrà mostrata come sfondo alla testata dell'articolo e come anteprima.</span>
    <input type="file" name="image" id="inputImage">
  </div>

  <div class="form-group">
    <label for="inputSummary">Breve descrizione</label>
    <span id="helpSummary" class="help-block">Un breve sommario dell'articolo, di lunghezza compresa tra 70 e 160 caratteri.</span>
    <textarea name="summary" id="inputSummary" class="form-control" placeholder="Breve descrizione"></textarea>
  </div>

  <div class="form-group">
    <label for="inputContent">Contenuto</label>
    <textarea name="content" id="inputContent" placeholder="Contenuto" required></textarea>
  </div>

  <button type="submit" class="btn btn-primary btn-block">Pubblica Articolo</button>
</form>
