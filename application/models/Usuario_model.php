<?php
class Usuario_model extends CI_Model {
  public function __construct(){
    parent::__construct();
      // Your own constructor code
  }
  //Muestra el listado de no se que
  function listado($id){
    $condicion = array(
      'IdArea' => $this->session->userdata('area'),
      'Estado' => 1
    );
    $this->db->limit(5);
    $consulta = $this->db->get_where('eventos', $condicion);
    return $consulta;
  }

  //Se agrega un usuario para que pueda participar en la votacion
  function usuario_agregar($datos){
    $this->db->insert('participantes', $datos);
    return $this->db->insert_id();
  }

  //Obtiene la prgunta en base al Id generado por el admin

  function pregunta($id){
    $condicion = array(
      'IdPregunta' => $id
    );

    $consulta = $this->db->get_where('preguntas', $condicion);
    return $consulta;
  }

  //Inserta una respuesta a la base de datos
  function agregarRespuesta($insert){
    $this->db->insert('respuestas', $insert);
  }

  //Muestra la lista de respuestas de cada pregunta

  function respuestas($id){
    $condicion = array(
      'IdPregunta' => $id
    );
    $this->db->order_by('Votos', 'DESC');
    $consulta = $this->db->get_where('respuestas', $condicion);
    return $consulta;
  }

  //Agrega un +1 al contador de votos de la respuesta
  function votarUp($id){
    $condicion = array(
      'IdRespuesta' => $id
    );

    $consulta = $this->db->get_where('respuestas', $condicion);
    foreach($consulta -> result() as $row){
      $sumar = $row->Votos + 1;

      $condicion2 = array(
        'Votos' => $sumar
      );
    }

    $this->db->where('IdRespuesta', $id);
    $this->db->update('respuestas', $condicion2);

    return $consulta;
  }

  //muestra las respuestas ma votadas
  function masVotados($id){
    $condicion = array(
      'IdPregunta' => $id
    );

    $this->db->order_by('Votos', 'DESC');
    $this->db->limit(5);
    $consulta = $this->db->get_where('respuestas', $condicion);
    return $consulta;
  }
}
