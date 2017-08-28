<h2>Cerca</h2>
<form action="/cerca" method="GET" class="form-inline">
  <div class="input-group">
    <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
    <input type="text" class="form-control" name="q" placeholder="Cerca" <?= (isset($query) ? 'value="' . $query . '"' : '') ?>>
    <span class="input-group-btn">
      <button type="submit" class="btn btn-primary" type="button">Cerca</button>
    </span>
  </div>
</form>