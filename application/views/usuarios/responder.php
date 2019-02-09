<div class="container">
  <div class="row">
    <div class="col s12 m12 l12">
      <?php
        if($pregunta -> num_rows() > 0){
          foreach($pregunta -> result() as $row){
            echo '<h2>'.$row->Pregunta.'</h2>';
          }
        }
      ?>
    </div>
  </div>
  <div class="row">
    <div class="col s12 m12 l12">
      <?=form_open()?>
        <div class="input-field col s12">
          <textarea id="textarea1" class="materialize-textarea" name="Respuesta"></textarea>
          <label for="textarea1">Respuesta</label>
        </div>
        <input type="submit" name="" value="Responder" class="btn-large blue center">
      <?=form_close()?>
    </div>
  </div>
</div>
