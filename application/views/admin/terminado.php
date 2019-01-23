<?php
  if($evento -> num_rows() > 0){
    foreach($evento -> result() as $row){
?>
      <div class="row">
        <div class="col s10 m10 l10">
          <div class="col s8 m8 l8 push-s2 push-m2 push-l2">
            <div class="card white darken-1">
              <div class="card-content black-text" style="overflow: hidden; ">
                <h3>Registro Terminado</h3>
                <p>
                  <h4><b>Evento: </b><?=$row->Evento?></h4>
                </p>

                <p>
                  recuerda proporcionar esta clave a los participantes
                </p>
                <p>
                  <table>
                    <tr>
                      <th>ClavePregunta</th>
                      <th>Pregunta</th>
                      </tr>
                      <?php
                        if($preguntas -> num_rows() > 0){
                          foreach($preguntas -> result() as $pregunta){
                      ?>
                            <tr>
                              <td><?=$pregunta->ClavePregunta?></td>
                              <td><?=$pregunta->Pregunta?></td>
                            </tr>
                      <?php
                          }
                        }
                      ?>
                  </table>
                </p>
              </div>
            </div>
          </div>
      </div>

<?php
    }
  }
?>
