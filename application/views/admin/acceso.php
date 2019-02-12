<?php
  $atributos = array('class' => 'formulario');
  $formulario = array(
    'Usuario' => array(
      'type'  => 'text',
      'class' => 'input_text',
      'name'  => 'Usuario'
    ),
    'Contra' => array(
      'type'  => 'password',
      'class' => 'input_text',
      'name'  => 'Contra'
    ),
    'Boton' => array(
      'type'  => 'submit',
      'class' => 'btn input_btn',
      'name'  => 'Boton',
      'value' => 'Iniciar'
    ),

  );
?>
<div class="container">
  <div class="row">
    <?=form_open('', $atributos)?>
      <h2>Inicio de Sesion</h2>
      <?=form_input($formulario['Usuario'])?>
      <?=form_input($formulario['Contra'])?>
      <?=form_input($formulario['Boton'])?>
    <?=form_close()?>
  </div>
</div>
