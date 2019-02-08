<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	function __construct() {
		parent::__construct();
    $this->load->library('session');
		$this->load->library('email');
    $this->load->library('comprobar');
    $this->load->library('menu');
		$this->load->model('Usuario_model');
	}

	// =======================================
	// Muestra todos los servicios solicitados por un usuario
	//
	// Fecha: 2018-06-01
	// =======================================

  public function index(){
    $this->load->view('theme/head');
    $this->load->view('theme/menu', $datos);
    $this->load->view('usuarios/inicio', $datos);
    $this->load->view('theme/foot');
  }

	// =======================================
	// registro de usuario para poder participar
	// de la actividad
	// Fecha: 2018-01-23
	// =======================================
	public function registro($id){
		if($_POST){
			$datos = array(
				'Nombre' => $this->input->post('Nombre'),
				'IdPregunta' => $id
			);

			$this->Usuario_model->usuario_agregar($datos);

			$redirect = 'usuario/responder/'.$this->session->userdata('id');
			redirect($redirect);
		}else{
			$this->load->view('theme/head');
			$this->load->view('usuarios/registro');
			$this->load->view('theme/foot');
		}
	}

	// =======================================
	// Guardado de la respuestas para cada una
	// de las preguntas de la actividad
	// Fecha: 2018-01-23
	// =======================================
	public function responder($id){

		$datos['pregunta'] = $this->Usuario_model->pregunta($id);
		if($_POST){

		}else{
			$this->load->view('theme/head');
			$this->load->view('usuarios/responder', $datos);
			$this->load->view('theme/foot');
		}
	}
}
