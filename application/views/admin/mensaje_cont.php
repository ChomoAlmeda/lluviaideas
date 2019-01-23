<?php

?>

<div class="row">
  <div class="col s10 m10 l10">
    <div class="col s8 m8 l8 push-s2 push-m2 push-l2">
      <div class="card white darken-1">
        <div class="card-content black-text" style="height: 300px; overflow: hidden; ">
          <h3>¿Desea Agregar otra Pregunta?</h3>

          <p class="col s12 m12 l12">

            <a href="<?=base_url()?>index.php/admin/nuevo_preguntas/<?=$id?>" class="btn green col s6 m4 l4 push-m1 push-l1">Si</a>
            <a href="<?=base_url()?>index.php/admin/terminado/<?=$id?>" class="btn red col s6 m4 l4 push-m2 push-l2">No</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
