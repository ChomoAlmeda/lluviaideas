<?php

?>

  <div class="col s10 m10 l10">
    <h3>Ultimos Servicios Registrados</h3>
    <hr>
    <div class="row">
      <?php
      if($verPendientes -> num_rows() > 0){
        foreach($verPendientes -> result() as $row){
      ?>
          <div class="col s4 m4 l4">
            <div class="card white darken-1">
              <div class="card-content black-text" style="height: 300px; overflow: hidden; ">
                <span class="card-title">No. <?=$row->IdServicio?></span>
                <p>Fecha Solicitud: <?=$row->Fecha?></p>
                <p><?=$row->Descripcion?></p>
                <a href="<?=base_url()?>includes/docs/<?=$row->Evidencia?>" target="_blank"><img src="<?=base_url()?>includes/docs/<?=$row->Evidencia?>"></a>
              </div>
              <div class="card-action">
                <a href="<?=base_url()?>admin/seguimiento/<?=$row->IdServicio?>" style="color: #003A66;">Ver</a>
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
  </div>
</div>
