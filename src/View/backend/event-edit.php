<form action="/manage-events/<?php echo $event->id; ?>" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="_method" value="PUT">

  <div class="row">
    <div class="col-sm-9">
      <div class="form-group">
        <label for="inputName">Nome</label>
        <input type="text" name="name" value="<?php echo $event->name; ?>" class="form-control" id="inputName" placeholder="Nome dell'evento" required>
      </div>

      <div class="form-group">
        <label for="inputPlace">Luogo</label>
        <input type="text" name="place" value="<?php echo $event->place; ?>" class="form-control" id="inputPlace" placeholder="Luogo" required>
      </div>

      <div class="form-group">
        <label for="inputDate">Data</label>
        <input type="datetime-local" name="date" value="<?php echo date('Y-m-d\TH:i', strtotime($event->date)); ?>" class="form-control" id="inputDate" placeholder="Data e ora" required>
      </div>

      <div class="form-group">
        <label for="inputImage">Locandina</label>
        <input type="file" name="image" id="inputImage">
      </div>
    </div>

    <div class="col-sm-3">
      <?php if (!empty($event->image)): ?>
      <img src="/image/<?php echo urlencode(str_replace("/", "|", $event->image)); ?>/128/256" alt="Locandina" class="img-responsive center-block">
      <?php else: ?>
      <p class="text-info bg-info">Nessuna immagine inserita.</p>
      <?php endif; ?>
    </div>
  </div>

  <div class="form-group">
    <label for="inputDescription">Descrizione</label>
    <textarea name="event_description" id="inputDescription" placeholder="Descrizione" required><?php echo $event->description; ?></textarea>
  </div>

  <button type="submit" class="btn btn-primary btn-block">Applica Modifiche</button>
</form>
