<style media="screen">
  li a {
    color: white;
    display: block;
    padding: 10px;
  }
</style>

<div class="row">
  <div class="col s2 m2 l2" style="background: #003A66; color: white; height: 100%;">
    <h3> <a href="<?=base_url()?>usuario" style="color: white;"> <?=$this->session->userdata('nombre')?></a></h3>
    <hr>
    <ul>
      <li>
        <a href="<?=base_url()?>usuario/generar">
          Generar Solicitud
        </a>
      </li>
      <hr>
      <li>
        <a href="<?=base_url()?>usuario/pendientes/<?=$this->session->userdata('id')?>">
          
        </a>
      </li>
      <hr>
      <li>
        <a href="<?=base_url()?>usuario/terminadas">
          Terminadas
        </a>
      </li>
      <hr>
      <li>
        <a href="<?=base_url()?>usuario/cerrar">
          Cerrar Sesion
        </a>
      </li>
      <hr>
    </ul>
  </div>
