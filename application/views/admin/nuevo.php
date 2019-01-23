<?php
  $atributos = array('class' => 'col s12 m12 l12 white z-depth-1');
  $formulario = array(
    'Nombre' => array(
      'name'  => 'Nombre',
      'id'    => 'Nombre',
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
  <h3>Preparar Nuevo Evento</h3>
  <hr>
  <div class="row">
    <div class="col s12 m12 l12">
      <?=form_open_multipart('', $atributos)?>
        <label for="Nombre">Nombre</label>
        <?=form_input($formulario['Nombre'])?>
        <input type="submit" class="btn col s4 m4 l4 push-s4 push-m4 push-l4" style="background: #003A66; margin: 10px 0px;" value="Nuevo Evento">
        <br><br>
      <?=form_close()?>

    </div>
  </div>
</div>
</div>
