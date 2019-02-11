<div class="container">
  <div class="row">
    <div class="col s12 m12 l12">
      <h2>
        <?php
          foreach($pregunta -> result() as $p){
            echo '<h2>'.$p->Pregunta.'</h2>';
          }
        ?>
      </h2>
     <h4>Respuestas mas Votadas</h4>
    </div>
  </div>
  <div class="row">
    <div class="col s12 m12 l12">
      <table>
        <tr>
          <th>#</th>
          <th>Respuestas</th>
          <th>Votos</th>

        </tr>
        <?php
          if($respuestas -> num_rows() > 0){
            foreach ($respuestas -> result() as $row) {
        ?>
          <tr>
            <td><?=$row->IdRespuesta?></td>
            <td><?=$row->Respuesta?></td>
            <td><?=$row->Votos?></td>

          </tr>
        <?php
            }
          }
        ?>

      </table>
    </div>
  </div>
</div>
