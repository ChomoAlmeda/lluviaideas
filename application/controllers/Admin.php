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
				'Usuario' => $this->input->post('Usuario'),
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

	public function GenerarPdf($ev, $id){
			$this->load->library('Pdf');
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Jesus Almeda');
			$pdf->SetTitle('Reporte de Actividad');
			$pdf->SetSubject('Documento PDF');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
		//	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
			$pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, 'Arrial', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, 'Arial', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
			$pdf->setFontSubsetting(true);

// Establecer el tipo de letra

//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
			$pdf->SetFont('Helvetica', '', 14, '', true);

// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
			$pdf->AddPage();

//fijar efecto de sombra en el texto
			//$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Establecemos el contenido para imprimir
$pregunta = $this->Admin_model->pregunta($id);
$participantes = $this->Admin_model->participantes($id);
$masVotados = $this->Admin_model->masVotadas($id);

foreach($pregunta -> result() as $pregunta){
	$html = '<h1>'.$pregunta->Pregunta.'</h1>';
}

	$html .= '<h3>Participantes</h3>
					 <table border="1">
					 	<tr>
							<th>
								<b>Nombre de los participantes</b>
							</th>
						</tr>';
foreach($participantes -> result() as $participante){
	$html .= '<tr>
							<td style="padding: 15px; display: block;">'
								.$participante->Nombre.
							'</td>
						</tr>';
}

$html .= '</table>';

$html .= '<h3>Respuestas</h3>
				 <table class="table" border="1">
					<tr>
						<th width="80%">
							<b>Respuesta</b>
						</th>
						<th width="20%">
							<b>Votos</b>
						</th>
					</tr>';

foreach($masVotados -> result() as $mas){
	$html .= '<tr>
							<td>'
								.$mas->Respuesta.
							'</td>
							<td>'
								.$mas->Votos.'</td>
						</tr>';
}

$html .= '</table>';






$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
			$nombre_archivo = utf8_decode("Reporte de Actividad");
			$pdf->Output($nombre_archivo, 'I');
	}
}
