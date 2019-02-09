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

  function usuario_agregar($datos){
    $this->db->insert('participantes', $datos);
    return $this->db->insert_id();
  }

  function pregunta($id){
    $condicion = array(
      'IdPregunta' => $id
    );

    $consulta = $this->db->get_where('preguntas', $condicion);
    return $consulta;
  }

  function agregarRespuesta($insert){
    $this->db->insert('respuestas', $insert);
  }

  function respuestas($id){
    $condicion = array(
      'IdPregunta' => $id
    );

    $consulta = $this->db->get_where('respuestas', $condicion);
    return $condicion;
  }
}
