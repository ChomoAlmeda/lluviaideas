<div class="col s10 m10 l10">
  <h3>Servicios Pendientes de Aprobacion</h3>
  <hr>
  <div class="row">
    <?php
    if($verPendientes -> num_rows() > 0){
      foreach($verPendientes -> result() as $row){

    ?>
        <div class="col s4 m4 l4" style="height: 800px;">
          <div class="card white darken-1">
            <div class="card-content black-text" style="height: 800px; ">
              <span class="card-title">No. <?=$row->IdServicio?></span>
              <p><?=$row->Descripcion?></p>
              <a href="<?=base_url()?>includes/docs/<?=$row->Evidencia?>" target="_blank"><img class="col s12 m12 l12" src="<?=base_url()?>includes/docs/<?=$row->Evidencia?>"></a>
              <br>
              <p><b>Seguimiento:</b> <?=$row->Comentarios?></p>
              <a href="<?=base_url()?>includes/docs/<?=$row->Evidencia?>" target="_blank"><img class="col s12 m12 l12" src="<?=base_url()?>includes/docs/<?=$row->EvidenciaSeg?>"></a>
            </div>
            <div class="card-action" style="height: 50px;">
              <a href="<?=base_url()?>usuario/aprobar/<?=$row->IdServicio?>" style="color: #003A66;">Aprobar</a>
            </div>
          </div>
        </div>
    <?php
      }
    }else{?>
      <div class="col s12 m12 l12">
        <h4>No hay servicios Pendientes</h4>
      </div>
    <?php
    }
    ?>
  </div>
</div>
</div>
