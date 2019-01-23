<?php
$atributos = array('class' => 'col s12 m12 l12 white z-depth-1');
$formulario = array(
  'Pregunta' => array(
    'name'  => 'Pregunta',
    'id'    => 'Pregunta',
    'class' => 'validate',
  )
);

  if($evento -> num_rows() > 0){
    foreach($evento ->result() as $row){
?>
    <div class="col s10 m10 l10">
      <div class="row">
        <div class="col s12 m12 l12 white z-depth-1">
          <h4>Agregar Pregunta al Evento: <?=$row->Evento?></h4>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m12 l12">
          <label for="Pregunta">Pregunta</label>
          <?=form_open_multipart()?>
            <?=form_input($formulario['Pregunta'])?>
            <input type="submit" class="btn col s4 m4 l4 push-s4 push-m4 push-l4" style="background: #003A66; margin: 10px 0px;" value="Agregar Pregunta">
            <br><br>
          <?=form_close()?>
        </div>
      </div>
    </div>
<?php

    }
  }
?>
