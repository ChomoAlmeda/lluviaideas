<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct() {
		parent::__construct();
    $this->load->library('session');
    $this->load->library('comprobar');
    $this->load->library('menua');
		$this->load->model('Admin_model');
	}

  // =======================================
	// Muestra todos los servicios pendientes para
	// que el administrador lo revise
	// Fecha: 2018-06-05
	// =======================================

  public function index(){
    $datos['servicios'] = $this->Admin_model->listado($this->session->userdata('id'));
    $datos['pendientesRevision'] = $this->Admin_model->pendientesRevision($this->session->userdata('id'));
    $this->load->view('theme/head');
    $this->load->view('theme/menua', $datos);
    $this->load->view('usuarios/inicio', $datos);
    $this->load->view('theme/foot');
  }

	// =======================================
	// Muestra el listado de los servicios pendientes
	//
	// Fecha: 2018-11-06
	// =======================================

	public function pendientes($id = 0){
		$datos['pendientesRevision'] = $this->Admin_model->pendientesRevision($this->session->userdata('id'));
    $datos['verPendientes'] = $this->Admin_model->verPendientes();
		$this->load->view('theme/head');
    $this->load->view('theme/menua', $datos);
    $this->load->view('admin/pendientes', $datos);
    $this->load->view('theme/foot');
	}


	// =======================================
	// Muesrtra la descripcion del servicios y proporciona el
	// formulario para agregar un comentario
	//
	// Fecha: 2018-11-06
	// =======================================
	public function seguimiento($id){
		if($_POST){
			$insertar = array(
				'IdServicio' => $id,
				'Comentarios' => $this->input->post("Comentarios"),
				'Fecha' => date('Y-m-d')
			);

			$this->Admin_model->agregarComentario($insertar);
			redirect('admin/pendientes');

		}else{
			$datos['pendientesRevision'] = $this->Admin_model->pendientesRevision($this->session->userdata('id'));
			$datos['seguimiento'] = $this->Admin_model->seguimiento($id);
			$this->load->view('theme/head');
			$this->load->view('theme/menua', $datos);
			$this->load->view('admin/seguimiento', $datos);
			$this->load->view('theme/foot');
		}


	}

}
