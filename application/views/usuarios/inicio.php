<?php

?>

  <div class="col s10 m10 l10">
    <h3>Ultimos Servicios Registrados</h3>
    <hr>
    <div class="row">
      <?php
        foreach($servicios -> result() as $row){
      ?>
          <div class="col s4 m4 l4">
            <div class="card white darken-1">
              <div class="card-content black-text" style="height: 300px; overflow: hidden; ">
                <span class="card-title">No. <?=$row->IdServicio?></span>
                <p><?=$row->Descripcion?></p>
                <img class="col s12 m12 l12" src="<?=base_url()?>includes/docs/<?=$row->Evidencia?>" alt="">
              </div>

              <div class="card-action">
                <a href="#" style="color: #003A66;">Ver</a>
              </div>
            </div>
          </div>
      <?php
        }
      ?>
    </div>
  </div>
</div>
