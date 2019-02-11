<div class="container">
  <div class="row">
    <div class="col s12 m12 l12">
      <table>
        <tr>
          <th>#</th>
          <th>Pregunta</th>
          <th>Votos</th>
          <th colspan="2"></th>
        </tr>
        <?php
          if($respuestas -> num_rows() > 0){
            foreach ($respuestas -> result() as $row) {
        ?>
          <tr>
            <td><?=$row->IdRespuesta?></td>
            <td><?=$row->Respuesta?></td>
            <td><?=$row->Votos?></td>
            <td><a href="#" class="green-text"><i class="material-icons">file_upload</i></a></td>
            <td><a href="#" class="red-text"><i class="material-icons">file_download</i></a></td>
          </tr>
        <?php
            }
          }
        ?>
        <tr>
          <td></td>
        </tr>

      </table>
    </div>
  </div>
</div>
