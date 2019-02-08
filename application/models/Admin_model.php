<?php
class Admin_model extends CI_Model {
  public function __construct(){
    parent::__construct();
      // Your own constructor code
  }

  public function listado(){
    $condicion = array(
      'eventos.IdArea' => $this->session->userdata('area')
    );

    //$this->db->group_by('eventos.IdEvento', 'DESC');
    $this->db->join('eventos', 'eventos.IdEvento = preguntas.IdEvento');
    $consulta = $this->db->get_where('preguntas', $condicion);
    return $consulta;
  }

  public function nuevo_evento($insert){
    $this->db->insert('eventos', $insert);
    return $this->db->insert_id();
  }

  public function evento($id){
    $condicion = array(
      'eventos.IdEvento' => $id
    );
    $consulta = $this->db->get_where('eventos', $condicion);
    return $consulta;
  }

  public function inserta_nueva_pregunta($insert){
    $this->db->insert('preguntas', $insert);
    return $this->db->insert_id();
  }

  public function preguntas($id){
    $condicion = array(
      'IdEvento' => $id
    );
    $consulta = $this->db->get_where('preguntas', $condicion);
    return $consulta;
  }
}
