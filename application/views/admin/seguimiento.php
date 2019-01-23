  <div class="col s10 m10 l10">
    <h3>Seguimiento de Servicio</h3>
    <hr>
    <div class="row">
      <?php
      if($seguimiento -> num_rows() > 0){
        foreach($seguimiento -> result() as $row){
      ?>
          <div class="col s6 m6 l6">
            <div class="card white darken-1">
              <div class="card-content black-text">
                <span class="card-title">No. <?=$row->IdServicio?></span>
                <p><?=$row->Descripcion?></p>
                <br>
                <?=form_open_multipart('')?>
                  <label for="textarea1">Comentarios:</label>
                  <textarea id="textarea1" name="Comentarios" class="materialize-textarea" style="margin-bottom: 15px;"></textarea>
                  <div class="file-field input-field col s12 m12 l12">
                    <div class="btn" style="background: #003A66">
                      <span>Evidencia</span>
                      <input type="file" name="Doc">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" name="Doc">
                    </div>
                  </div>
                  <center><input type="Submit" name="Buton" class="btn" value="Terminar"></center>
                  <br><br>
                <?=form_close()?>
              </div>
            </div>
          </div>
          <div class="col s6 m6 l6">
            <div class="card white darken-1" style="height: 350px;">
              <div class="card-content black-text">
                <img class="col s12 m12 l12" src="<?=base_url()?>includes/docs/<?=$row->Evidencia?>" alt="">
              </div>
            </div>
          </div>
      <?php
        }
      }else{
        echo "No hay datos";
      }
      ?>
    </div>
    <br><br><br>
  </div>
  <br><br><br>
</div>
