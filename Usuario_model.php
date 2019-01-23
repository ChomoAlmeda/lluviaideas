<?php
class Usuario_model extends CI_Model {
  public function __construct(){
    parent::__construct();
      // Your own constructor code
  }

  function listado($id){
    $condicion = array(
      'IdUsuario' => $id,
      'Estado' => 1
    );
    $this->db->limit(5);
    $consulta = $this->db->get_where('servicios', $condicion);
    return $consulta;
  }

  function pendientesRevision($id){
    $this->db->where('Estado', '2');
    $this->db->where('IdUsuario', $id);
    $this->db->from('servicios');
    $consulta = $this->db->count_all_results();
    return $consulta;
  }

  function verPendientes($id){
    $condicion = array(
      'servicios.IdUsuario' => $id,
      'servicios.Estado' => '2'
    );

    $this->db->join('seguimiento', 'seguimiento.IdServicio = servicios.IdServicio');
    $consulta = $this->db->get_where('servicios', $condicion);
    return $consulta;
  }

  function verTerminadas($id){
    $condicion = array(
      'servicios.IdUsuario' => $id,
      'servicios.Estado' => '3'
    );
    $this->db->order_by('seguimiento.Fecha');
    $this->db->join('seguimiento', 'seguimiento.IdServicio = servicios.IdServicio');
    $consulta = $this->db->get_where('servicios', $condicion);
    return $consulta;
  }

  function aprobar($id){
    $actualizar = array(
      'Estado' => 3
    );
    $this->db->where('IdServicio', $id);
    $this->db->update('servicios', $actualizar);
  }


  function generarServicio($agregar){
    $this->db->insert('servicios', $agregar);
  }

}
