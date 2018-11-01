<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
	}
	
	public function index(){
		if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'admin'){
			redirect(base_url().'login');
		}
		$data['titulo'] = 'Bienvenido Administrador';
		$this->load->view('admin_view',$data);
	}
   
	public function subir(){
		//Ruta donde se guardan los ficheros
		$config['upload_path'] = './subidas/';
		//Tipos de ficheros permitidos
		$config['allowed_types'] = 'gif|jpg|png';
		//Se pueden configurar aun mas parámetros.
		//Cargamos la librería de subida y le pasamos la configuración
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload()){
			/*Si al subirse hay algún error lo meto en un array para pasárselo a la vista*/
			$error=array('error' => $this->upload->display_errors());
			$this->load->view('subir_view', $error);
		}else{
			//Datos del fichero subido
			$datos["img"]=$this->upload->data();
			// Podemos acceder a todas las propiedades del fichero subido
			// $datos["img"]["file_name"]);
			//Cargamos la vista y le pasamos los datos
			$this->load->view('subir_view', $datos);
		}  
	}

}
?>
