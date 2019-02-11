<div class="container">
  <div class="row">
    <div class="col s12 m12 l12">
      <table>
        <tr>
          <th>#</th>
          <th>Pregunta</th>
          <th>Votos</th>
          <th></th>
        </tr>
        <?php
          if($respuestas -> num_rows() > 0){
            foreach ($respuestas -> result() as $row) {
        ?>
          <tr>
            <td><?=$row->IdRespuesta?></td>
            <td><?=$row->Respuesta?></td>
            <td><?=$row->Votos?></td>
            <td><a href="<?=base_url()?>index.php/usuario/votarUp/<?=$row->IdRespuesta?>/<?=$row->IdPregunta?>" class="green-text"><i class="material-icons">file_upload</i></a></td>
          </tr>
        <?php
            }
          }
        ?>

      </table>
    </div>
  </div>
</div>
