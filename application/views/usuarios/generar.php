<?php
  $atributos = array('class' => 'col s12 m12 l12 white z-depth-1');
  $formulario = array(
    'Area' => array(
      'name'  => 'Area',
      'id'    => 'Area',
      'class' => 'validate',
    ),
    'Quien' => array(
      'name'  => 'Quien',
      'id'    => 'Quien',
      'class' => 'validate',
    ),
    'Extension' => array(
      'name'  => 'Extension',
      'id'    => 'Extension',
      'class' => 'validate',
    ),
    'Descripcion' => array(
      'name'  => 'Descripcion',
      'id'    => 'Descripcion',
      'class' => 'materialize-textarea',
      'rows'  => '5'
    ),

    'Doc' => array(
      'name'  => 'Doc',
      'id'    => 'Doc',
      'class' => 'materialize-textarea',
      'rows'  => '5'
    )
  );
?>
<div class="col s10 m10 l10">
  <h3>Generar Orden de Servicio</h3>
  <hr>
  <div class="row">
    <div class="col s12 m12 l12">
      <?=form_open_multipart('', $atributos)?>
        <label for="Area">Area</label>
        <?=form_input($formulario['Area'])?>
        <label for="Quien">Quien Solicita</label>
        <?=form_input($formulario['Quien'])?>
        <label for="Descripcion">Descripcion</label>
        <?=form_textarea($formulario['Descripcion'])?>
        <div class="file-field input-field col s12 m12 l12">
          <div class="btn" style="background: #003A66">
            <span>Evidencia</span>
            <input type="file" name="Doc">
          </div>
          <div class="file-path-wrapper">
              <input class="file-path validate" type="text" name="Doc">
          </div>
        </div>
        <input type="submit" class="btn col s4 m4 l4 push-s4 push-m4 push-l4" style="background: #003A66; margin: 10px 0px;" value="Generar Solicitud">
        <br><br>
      <?=form_close()?>

    </div>
  </div>
</div>
</div>
