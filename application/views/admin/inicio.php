<?php

?>

  <div class="col s10 m10 l10">
    <h3>Ultimos Eventos del Area</h3>
    <hr>
    <div class="row">
      <?php
      if($eventos -> num_rows() > 0){
        foreach($eventos -> result() as $row){
      ?>
          <div class="col s4 m4 l4">
            <div class="card white darken-1">
              <div class="card-content black-text" style="overflow: hidden; ">
                <span class="card-title">No. <?=$row->IdEvento?></span>
                <p><b>Evento: </b><?=$row->Evento?></p>
                <p><b>Fecha: </b><?=$row->Fecha?></p>
              </div>
              <div class="card-action">
                <a href="<?=base_url()?>index.php/admin/verEvento/<?=$row->IdEvento?>">Ver Informacion</a>
              </div>
            </div>
          </div>
      <?php
        }
      }else{
        echo "No hay Informacion de Eventos Recientes";
      }
      ?>
    </div>
  </div>
</div>
