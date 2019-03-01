<?php
class Inicio_model extends CI_Model {
  public function __construct(){
    parent::__construct();
      // Your own constructor code
  }

  // =======================================
  // Funcion para el acceso del usuario
  //
  // Fecha: 2019-01-21
  // =======================================
  function acceso($datos){
    
    $consulta = $this->db->get_where('usuarios', $datos);
    return $consulta;
  }
}
