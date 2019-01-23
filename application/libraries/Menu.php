<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// =======================================
// Clase para comprobar los datos de acceso
// del usuario, a su vez comprueba el estado
// de la sesion
//
// Fecha: 2018-06-06
// =======================================
class Menu {

  public function __construct(){
    $CI =& get_instance();
    $CI->load->database();
    $consulta = $CI->db->get('usuarios');
  }
}
