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
				'IdPregunta' => $id,
			);

			$idu = $this->Usuario_model->usuario_agregar($datos);

			$redirect = 'usuario/responder/'.$this->session->userdata('id').'/'.$idu;
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
	// Fecha: 2019-01-23
	// =======================================
	public function responder($id, $idu){
		//$datos['respuestas'] = $this->Usuario_model->votarUp($id);
		$datos['pregunta'] = $this->Usuario_model->pregunta($id);
		if($_POST){
			$insert=array(
				'Respuesta' => $this->input->post('Respuesta'),
				'IdPregunta' => $id,
				'IdUsuario' => $idu
			);
			$consulta = $this->Usuario_model->agregarRespuesta($insert);
			if($consulta -> num_rows() >= 5){
				$redirect = '/usuario/votar/'.$id;
			}else{
				$redirect = 'usuario/mensaje/'.$this->session->userdata('id').'/'.$idu;
			}

			redirect($redirect);
		}else{
			$this->load->view('theme/head');
			$this->load->view('usuarios/responder', $datos);
			$this->load->view('theme/foot');
		}
	}

	//==========================
	// 2019-02-09
	// Muestras las respuestas para que sean votadas
	// Por los participantes
	//==========================

	public function votar($id){
		$datos['respuestas'] = $this->Usuario_model->respuestas($id);
		$this->load->view('theme/head');
		$this->load->view('usuarios/votar', $datos);
		$this->load->view('theme/foot');
	}

	//==========================
	// 2019-02-11
	// Muestras las respuestas para que sean votadas
	// Por los participantes
	//==========================

	public function votarUp($id, $idp){
		$datos['respuestas'] = $this->Usuario_model->votarUp($id);

		$contadorv = array(
			'i' => $this->session->userdata('i') + 1,
		);
		$this->session->set_userdata($contadorv);

		if( $this->session->userdata('i') >= 5){
			$redirect = 'usuario/masvotados/'.$idp;
		}else{
			$redirect = 'usuario/votar/'.$idp;
		}
		redirect($redirect);
	}


	public function masvotados($idp){
		$datos['pregunta'] = $this->Usuario_model->pregunta($idp);
		$datos['respuestas'] = $this->Usuario_model->masVotados($idp);

		$this->load->view('theme/head');
		$this->load->view('usuarios/masvotados', $datos);
		$this->load->view('theme/foot');
		$this->session->sess_destroy();
	}

	//==========================
	// 2019-02-09
	// Pregunta al participante si desea agregar otra respuesta
	//==========================

	public function mensaje($id, $idu){
		$datos['id'] = $id;
		$datos['idu'] = $idu;
		$this->load->view('theme/head');
		$this->load->view('usuarios/mensaje', $datos);
		$this->load->view('theme/foot');
	}
}
