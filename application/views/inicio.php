<?php
  // =======================================
  // Formulario para el acceso al sistema
  //
  // Fecha: 2019-01-21
  // =======================================
  
  $atributos = array('class' => 'form');
  $formulario = array(
    'Nombre' => array(
      'type' => 'text',
      'name'  => 'Nombre',
      'class' => 'validate',
      'placeholder' => 'Nombre'
    ),
    'Contra' => array(
      'type' => 'password',
      'name'  => 'Contra',
      'class' => 'validate',
      'placeholder' => 'Contraseña'
    ),
  );

?>

<div class="container">
  <br><br>
  <div class="row">
    <div class="col s8 m8 l8 push-s2 push-m2 push-l2 z-depth-1 white">
      <?=form_open()?>
        <br>
        <?=form_input($formulario['Nombre'])?>
        <?=form_input($formulario['Contra'])?>
        <br><br>
        <input class="btn col s4 l4 m4 push-s4 push-m4 push-l4" type="submit" value="Ingresar">
      <?=form_close()?>
      <br><br><br>
    </div>
  </div>
</div>
