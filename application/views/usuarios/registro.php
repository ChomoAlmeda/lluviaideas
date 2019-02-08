<?php
$atributos = array('class' => 'col s12 m12 l12 white z-depth-1');
$formulario = array(
  'Nombre' => array(
    'name'  => 'Nombre',
    'id'    => 'Nombre',
    'class' => 'validate',
  )
);
?>
<div class="row container">
  <div class="col s12 m12 l12 white">
    <h3>Para continuar proporciona un Nombre</h3>
    <label for="Nombre">Tú Nombre: </label>
    <?=form_open_multipart()?>
      <?=form_input($formulario['Nombre'])?>
      <input type="submit" class="btn col s4 m4 l4 push-s4 push-m4 push-l4" style="background: #003A66; margin: 10px 0px;" value="Registrar">
      <br><br>
    <?=form_close()?>
  </div>
</div>
