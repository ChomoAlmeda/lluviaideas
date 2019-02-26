<?php

?>

<div class="col s10 m10 l10">
  <div class="nav-wrapper">
    <div class="col s12" >
      <a href="<?=base_url()?>index.php/admin/inicio" class="breadcrumb" style="color: black;">Inicio</a>
      <a href="<?=base_url()?>index.php/admin/verEvento/<?=$id?>" class="breadcrumb" style="color: black;">Eventos</a>
    </div>
  </div>
  <h3>Ver informacion del Evento</h3>
  <hr>
  <div class="row">
    <?php
    if($evento -> num_rows() > 0){
      foreach($evento -> result() as $row){
    ?>
        <div class="col s4 m4 l4">
          <div class="card white darken-1">
            <div class="card-content black-text" style="overflow: hidden; ">
              <span class="card-title">No. <?=$row->IdEvento?></span>
              <p><b>Evento: </b><?=$row->Evento?></p>
              <p><b>Fecha: </b><?=$row->Fecha?></p>
              <p>
                <table>
                  <tr>
                    <th>Preguntas</th>
                  </tr>

                    <?php
                      foreach($preguntas -> result() as $p){
                    ?>
                      <tr>
                        <td><a href="<?=base_url()?>index.php/admin/verEstadisticas/<?=$p->IdEvento?>/<?=$p->IdPregunta?>"><?=$p->Pregunta?></a></td>
                      </tr>
                    <?php
                      }
                    ?>

                </table>
              </p>
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
