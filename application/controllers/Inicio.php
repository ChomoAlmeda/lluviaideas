<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Inicio_model');
	}

	// =======================================
	// Controlador para cargar el inicio
	//
	// Fecha: 2018-05-31
	// =======================================
	public function index(){
		if($_POST) {

			$datos = array(
				'ClavePregunta' => $this->input->post('IdPregunta'),
			);

			$consulta = $this->Inicio_model->acceso($datos);

			if($consulta -> num_rows() > 0){
				foreach($consulta -> result() as $row){
					$sesion = array(
						'id'							=> $row->IdPregunta,
						'ClavePregunta'		=> $this->input->post('IdPregunta'),
					);

					$this->session->set_userdata($sesion);
					$idp = $this->session->userdata('id');
					$redirect = 'usuario/registro/'.$idp;
					redirect($redirect);
				}
			}else{
				echo 'Reintentalo';
			}
		}else{
			$this->load->view('theme/head');
			$this->load->view('inicio', $datos);
			$this->load->view('theme/foot');
		}
	}
}
