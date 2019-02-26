<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct() {
		parent::__construct();
    $this->load->library('session');

    $this->load->library('menua');
		$this->load->model('Admin_model');
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

			$consulta = $this->Admin_model->acceso($datos);

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
						redirect('admin/inicio');
					}else{
						redirect('usuario');
					}
				}
			}else{
				echo 'Reintentalo';
			}
		}else{
			$this->load->view('theme/head');
			$this->load->view('admin/acceso');
			$this->load->view('theme/foot');
		}
	}

  // =======================================
	// Controlador para la creacion de eventos
	// esto sera tarea de los administradores
	// Fecha: 2019-01-21
	// =======================================
  public function inicio(){
		$datos['eventos'] = $this->Admin_model->listado();
    $this->load->view('theme/head');
    $this->load->view('theme/menua');
    $this->load->view('admin/inicio', $datos);
    $this->load->view('theme/foot');
  }

	// =======================================
	// Funcion para dar de alta eventos en la plataforma
	//
	// Fecha: 2019-01-22
	// =======================================
	public function nuevo(){
		if($_POST){
			$insert = array(
				'IdArea'				=> $this->session->userdata('area'),
				'Evento'				=> $this->input->post('Nombre'),
				'Fecha'					=> date('Y-m-d')
			);
			$id = $this->Admin_model->nuevo_evento($insert);

			echo $id;
			$redirect = 'admin/nuevo_preguntas/'.$id;
			redirect($redirect);
		}else{
			$this->load->view('theme/head');
	    $this->load->view('theme/menua');
	    $this->load->view('admin/nuevo');
	    $this->load->view('theme/foot');
		}
	}

	// =======================================
	// Controlador que agrega las preguntas a su evento
	// correspondiente
	//
	// Fecha: 2019-01-22
	// =======================================
	public function nuevo_preguntas($id){
		if($_POST){
			$clave = rand(0,999);
			$insertar = array(
				'IdEvento' 			=> $id,
				'ClavePregunta'	=> $id.'-'.$clave,
				'Pregunta'			=> $this->input->post('Pregunta'),
				'Fecha'					=> date('Y-m-d')
			);

			$this->Admin_model->inserta_nueva_pregunta($insertar);
			$redirect = 'admin/nuevo_condicion/'.$id;
			redirect($redirect);

		}else{
			$datos['evento'] = $this->Admin_model->evento($id);
			$this->load->view('theme/head');
			$this->load->view('theme/menua');
			$this->load->view('admin/nuevo_pregunta', $datos);
			$this->load->view('theme/foot');
		}

	}

	// =======================================
	// Se encarga de preguntar al usuario si va a utilizar
	// o agregar preuntas al mismo evento
	//
	// Fecha:2019-01-23
	// =======================================

	public function nuevo_condicion($id){
		$datos['evento'] = $this->Admin_model->evento($id);
		$datos['id'] = $id;
		$this->load->view('theme/head');
		$this->load->view('theme/menua');
		$this->load->view('admin/mensaje_cont', $datos);
		$this->load->view('theme/foot');
	}

	// =======================================
	// Una vez que el evento fue terminado muestra
	// la informacion del evento y las preguntas
	// Fecha: 2019-01-23
	// =======================================
	public function terminado($id){
		$datos['evento'] = $this->Admin_model->evento($id);
		$datos['preguntas'] = $this->Admin_model->preguntas($id);
		$datos['participantes'] = $this->Admin_model->participantes($id);

		$this->load->view('theme/head');
		$this->load->view('theme/menua');
		$this->load->view('admin/terminado', $datos);
		$this->load->view('theme/foot');
	}

	public function verEvento($id){
		$datos['evento'] = $this->Admin_model->evento($id);
		$datos['preguntas'] = $this->Admin_model->preguntas($id);

		$datos['id'] = $id;


		$this->load->view('theme/head');
		$this->load->view('theme/menua');
		$this->load->view('admin/verEvento', $datos);
		$this->load->view('theme/foot');
	}

	public function verEstadisticas($ev, $id){
		$datos['evento'] = $this->Admin_model->evento($id);
		$datos['pregunta'] = $this->Admin_model->pregunta($id);
		$datos['participantes'] = $this->Admin_model->participantes($id);
		$datos['votadas'] = $this->Admin_model->masVotadas($id);
		$datos['id'] = $id;
		$datos['ev'] = $ev;

		$this->load->view('theme/head');
		$this->load->view('theme/menua');
		$this->load->view('admin/verEstadisticas', $datos);
		$this->load->view('theme/foot');
	}
}
