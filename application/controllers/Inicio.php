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
			$contra = md5($this->input->post('Contra'));
			$datos = array(
				'Usuario' => $this->input->post('Nombre'),
				'Contra' => $contra
			);

			$consulta = $this->Inicio_model->acceso($datos);

			if($consulta -> num_rows() > 0){
				foreach($consulta -> result() as $row){
					$sesion = array(
						'usuario'	=> $row->Usuario,
						'id'			=> $row->IdUsuario,
						'nombre' 	=> $row->Nombre,
						'tipo' 		=> $row->Tipo,
						'area'		=> $row->IdArea,
					);

					$this->session->set_userdata($sesion);
					$tipo = $this->session->userdata('tipo');

					echo $tipo;

					if($tipo == 1){
						redirect('admin');
					}else{
						redirect('usuario');
					}
				}
			}else{
				echo 'Reintentalo';
			}
		}else{
			$this->load->view('theme/head');
			$this->load->view('inicio');
			$this->load->view('theme/foot');
		}
	}
}
