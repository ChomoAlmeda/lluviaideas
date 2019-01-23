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
    $datos['servicios'] = $this->Usuario_model->listado($this->session->userdata('id'));
    $datos['pendientesRevision'] = $this->Usuario_model->pendientesRevision($this->session->userdata('id'));
    $this->load->view('theme/head');
    $this->load->view('theme/menu', $datos);
    $this->load->view('usuarios/inicio', $datos);
    $this->load->view('theme/foot');
  }

	// =======================================
	// Muestra los servicios pendientes de cada usuario
	//
	// Fecha: 2018-06-01
	// =======================================

  public function pendientes($id){
    $datos['verPendientes'] = $this->Usuario_model->verPendientes($this->session->userdata('id'));
    $datos['pendientesRevision'] = $this->Usuario_model->pendientesRevision($this->session->userdata('id'));
    $this->load->view('theme/head');
    $this->load->view('theme/menu', $datos);
    $this->load->view('usuarios/pendientes', $datos);
    $this->load->view('theme/foot');
  }



	// =======================================
	// Muestra el correo para realizar una solicitud de servicio
	//
	// Fecha: 2018-06-04
	// =======================================

	public function	generar(){
		if($_POST){

				$doc = $this->input->post('Doc');
				$nom_doc =substr(md5(uniqid(rand())),0,6);
				$config['file_name'] = $nom_doc;
				$config['upload_path'] = './includes/docs/';
				$config['allowed_types'] = 'pdf|jpg|jpeg|png|PDF';
				$config['max_size']	= '10000';

				$this->load->library('upload', $config);
				$upload_data = $this->upload->data();

					if(!$this->upload->do_upload('Doc')){
						echo "<script>
									alert('".$this->upload->display_errors()."');
									setTimeout(function(){

										 window.location.href = '".base_url()."index.php/Usuario/generar/';
									 }, 1000);

									</script>";
					}else{
						$id = rand(1,999);

						if($upload_data['file_ext'] == 'pdf' || 'jpg' || 'jpeg' || 'png'){
							$upload_data = $this->upload->data();
							$nom_doc = $nom_doc.$upload_data['file_ext'];
							echo $nom_doc;
							$equipo = $this->input->post('Equipo');
							$folio = $id.$equipo.rand(1000,9999);

							$agregar = array(
								'IdUsuario'		=> $this->session->userdata('id'),
								'Area'				=> $this->input->post('Area'),
								'Contacto'		=> $this->input->post('Quien'),
								'Descripcion'	=> $this->input->post('Descripcion'),
								'Estado'			=> '1',
								'Evidencia'		=> $nom_doc,
								'Fecha'				=> date('Y-m-d'),
							);

							$this->Usuario_model->generarServicio($agregar);
							redirect('usuario');
						}
					}


				//$resultado = $this->Usuario_model->generarServicio($agregar);
				//redirect('usuario/correo/'.$agregar['IdUsuario']);

		}else{
			$datos['pendientesRevision'] = $this->Usuario_model->pendientesRevision($this->session->userdata('id'));
	    $this->load->view('theme/head');
	    $this->load->view('theme/menu', $datos);
	    $this->load->view('usuarios/generar', $datos);
	    $this->load->view('theme/foot');
		}
	}

	// =======================================
	// Cambia el estado de los servicios a terminados
	//
	// Fecha: 2018-15-06
	// =======================================
	public function terminadas(){
		$datos['verTerminadas'] = $this->Usuario_model->verTerminadas($this->session->userdata('id'));
		$datos['pendientesRevision'] = $this->Usuario_model->pendientesRevision($this->session->userdata('id'));
		$this->load->view('theme/head');
		$this->load->view('theme/menu', $datos);
		$this->load->view('usuarios/terminadas', $datos);
		$this->load->view('theme/foot');
	}

	public function correo($id){
		$condicion = array(
			'IdUsuario' => $id
		);
		$consulta = $this->db->get_where('usuarios', $condicion);
		foreach($consulta -> result() as $row){
			//configuracion para gmail
		  $configUJED = array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.gmail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'jesus.almeda@ujed.mx',
		  'smtp_pass' => 'Emma_2914',
		  'mailtype' => 'html',
		  'charset' => 'utf-8',
		  'newline' => "\r\n"
		  );

			//cargamos la configuración para enviar con gmail
		  $this->email->initialize($configUJED);

		  $this->email->from('jesus.almeda@ujed.mx.');
		  $this->email->to($row->Correo);
		  $this->email->subject('Solicitud Recibida');
		  $this->email->message('<h2>Tu solicitud fue recibida y sera evaluada para su atencion</h2><hr><br> SIGC');
		  $this->email->send();
		  //con esto podemos ver el resultado
		  var_dump($this->email->print_debugger());
		}

		redirect('usuario');
	}


	// =======================================
	// funcion para aprobar los servicios pendientes
	//
	// Fecha: 2018-06-06
	// =======================================

	public function aprobar($id){
		$this->Usuario_model->aprobar($id);
		$u = $this->session->userdata('id');
		redirect('usuario/pendientes/'.$u);
	}


	// =======================================
	// Se muestra el mensaje despues de agregar
	// de manera correcta el servicio
	//
	// Fecha: 2018-06-04
	// =======================================
	public function mensaje_ok(){
		echo "Servicio Agregado!!";
		echo '
			<script>
				window.setTimeout(function(){
					window.location.href = "'.base_url().'usuario";}, 2500);
			</script>
		';
	}

	public function cerrar(){
		$this->session->sess_destroy();
		$datos['verTerminadas'] = $this->Usuario_model->verTerminadas($this->session->userdata('id'));
		$datos['pendientesRevision'] = $this->Usuario_model->pendientesRevision($this->session->userdata('id'));
		$this->load->view('theme/head');
		$this->load->view('theme/menu', $datos);
		$this->load->view('usuarios/cerrar');
		$this->load->view('theme/foot');
	}
}
