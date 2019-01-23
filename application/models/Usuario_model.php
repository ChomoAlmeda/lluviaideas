<?php
class Usuario_model extends CI_Model {
  public function __construct(){
    parent::__construct();
      // Your own constructor code
  }

  function listado($id){
    $condicion = array(
      'IdArea' => $this->session->userdata('area'),
      'Estado' => 1
    );
    $this->db->limit(5);
    $consulta = $this->db->get_where('eventos', $condicion);
    return $consulta;
  }

}
