
<div class="col s10 m10 l10">
  <div class="nav-wrapper">
    <div class="col s12" >
      <a href="<?=base_url()?>index.php/admin/inicio" class="breadcrumb" style="color: black;">Inicio</a>
      <a href="<?=base_url()?>index.php/admin/verEvento/<?=$ev?>/<?=$id?>" class="breadcrumb" style="color: black;">Eventos</a>
      <a href="#" class="breadcrumb" style="color: black;">Estadisticas</a>
    </div>
  </div>

  <h3>Ver informacion del Evento</h3>
  <hr>
  <div class="row">
    <?php
    if($pregunta -> num_rows() > 0){
      foreach($pregunta -> result() as $row){
    ?>
        <div class="col s12 m12 l12">
          <div class="card white darken-1">
            <div class="card-content black-text" style="overflow: hidden; ">
              <h3><?=$row->Pregunta?></h3>
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
  <div class="row">

    <div class="col s4 m4 l4">
      <div class="card white darken-1">
        <div class="card-content black-text" style="overflow: hidden; ">
          <span class="card-title">Participantes</span>
          <p>
            <table>
              <tr>
                <th>Nombre</th>
              </tr>

                <?php
                  foreach($participantes -> result() as $pa){
                ?>
                  <tr>
                    <td><?=$pa->Nombre?></td>
                  </tr>
                <?php
                  }
                ?>

            </table>
          </p>
        </div>

      </div>
    </div>

    <div class="col s4 m4 l4">
      <div class="card white darken-1">
        <div class="card-content black-text" style="overflow: hidden; ">
          <span class="card-title">Respuestas mas Votadas</span>
          <p>
            <table>
              <tr>
                <th>Respuesta</th>
                <th>Votos</th>
              </tr>

                <?php
                  foreach($votadas -> result() as $vo){
                ?>
                  <tr>
                    <td><?=$vo->Respuesta?></td>
                    <td><?=$vo->Votos?></td>
                  </tr>
                <?php
                  }
                ?>

            </table>
          </p>
        </div>

      </div>
    </div>
