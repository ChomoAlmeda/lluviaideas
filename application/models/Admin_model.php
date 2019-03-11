<?php
class Admin_model extends CI_Model {
  public function __construct(){
    parent::__construct();
      // Your own constructor code
  }

  public function acceso($datos){
    $consulta = $this->db->get_where('usuarios', $condicion);
    return $consulta;
  }

  public function listado(){
    $condicion = array(
      'eventos.IdArea' => $this->session->userdata('area')
    );
    $consulta = $this->db->get_where('eventos', $condicion);
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
    $this->db->insert('respuestas', $insert);
    return $this->db->insert_id();
  }

  public function preguntas($id){
    $condicion = array(
      'IdEvento' => $id
    );
    $consulta = $this->db->get_where('preguntas', $condicion);
    return $consulta;
  }

  public function pregunta($id){
    $condicion = array(
      'IdPregunta' => $id
    );
    $consulta = $this->db->get_where('preguntas', $condicion);
    return $consulta;

  }

  public function participantes($id){
    $condicion = array(
      'IdPregunta' => $id
    );
    $consulta = $this->db->get_where('participantes', $condicion);
    return $consulta;
  }

  public function masVotadas($id){
    $condicion = array(
      'respuestas.IdPregunta' => $id
    );
    $this->db->order_by('Votos', 'DESC');
    $this->db->limit(10);

    $consulta = $this->db->get_where('respuestas', $condicion);
    return $consulta;
  }
}
