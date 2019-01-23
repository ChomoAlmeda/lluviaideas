<div class="col s10 m10 l10">
  <h3>Servicios Pendientes de Aprobacion</h3>
  <hr>
  <div class="row">
    <?php
    if($verTerminadas -> num_rows() > 0){
      foreach($verTerminadas -> result() as $row){

    ?>
        <div class="col s4 m4 l4">
          <div class="card white darken-1">
            <div class="card-content black-text" style="height: 300px; overflow: scroll; ">
              <span class="card-title">No. <?=$row->IdServicio?></span>
              <p><?=$row->Descripcion?></p>
              <br>
              <p><b>Seguimiento:</b> <?=$row->Comentarios?></p>
            </div>
            <div class="card-action">
              
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
