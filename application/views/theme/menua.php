<style media="screen">
  li a {
    color: white;
    display: block;
    padding: 10px;
  }
</style>

<div class="row">
  <div class="col s2 m2 l2" style="background: #003A66; color: white; height: 100%;">
    <h3> <a href="<?=base_url()?>index.php/admin/inicio" style="color: white;"> <?=$this->session->userdata('nombre')?></a></h3>
    <hr>
    <ul>
      <li>
        <a href="<?=base_url()?>index.php/admin/nuevo/">
          Generar Nuevo Tablero
        </a>
      </li>
      <hr>
      <li>
        <a href="<?=base_url()?>index.php/admin/terminadas">
          Eventos Terminados
        </a>
      </li>
      <hr>
      <li>
        <a href="<?=base_url()?>index.php/admin/cerrar">
          Cerrar Sesion
        </a>
      </li>
    </ul>
  </div>
