<form action="/manage-events" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="inputName">Nome</label>
    <input type="text" name="name" class="form-control" id="inputName" placeholder="Nome dell'evento" required>
  </div>

  <div class="form-group">
    <label for="inputPlace">Luogo</label>
    <input type="text" name="place" class="form-control" id="inputPlace" placeholder="Luogo" required>
  </div>

  <div class="form-group">
    <label for="inputDate">Data</label>
    <input type="datetime-local" name="date" class="form-control" id="inputDate" placeholder="Data e ora" required>
  </div>

  <div class="form-group">
    <label for="inputImage">Locandina</label>
    <input type="file" name="image" id="inputImage">
  </div>

  <div class="form-group">
    <label for="inputDescription">Descrizione</label>
    <textarea name="event_description" id="inputDescription" placeholder="Descrizione" required></textarea>
  </div>

  <button type="submit" class="btn btn-primary btn-block">Inserisci Evento</button>
</form>
