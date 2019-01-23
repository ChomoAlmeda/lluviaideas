<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correo extends CI_Controller {
	function __construct() {
    parent::__construct();
    $this->load->library("email");
  }

public function index(){

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
 $this->email->to("iscalmeda@gmail.com");
 $this->email->subject('Bienvenido/a a uno-de-piera.com');
 $this->email->message('<h2>Email enviado con codeigniter haciendo uso del smtp de gmail</h2><hr><br> Bienvenido al blog');
 $this->email->send();
 //con esto podemos ver el resultado
 var_dump($this->email->print_debugger());
 }
}
