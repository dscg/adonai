<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recepcion extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url', 'html', 'form'));
		$this->load->model('recepcion_model');
	}

	public function index(){
		$data['clientes'] = $this->recepcion_model->listarCliente();
		$this->load->view('recepcion_view', $data);
	}
	
	public function listaRegistroManual(){
		$data['puestos'] = $this->admin_model->listarPuesto();
		$data['servicios'] = $this->admin_model->listarServicio();
		header('Content-Type: application/json');
		echo json_encode($data);
	}


	 public function generarImgQR($data_qr, $folder,$nombreArchivo){
		 //cargamos la librería
		 $this->load->library('ciqrcode');
		 //hacemos configuraciones
		 $params['data'] = $data_qr;
		 $params['level'] = 'H';
		 $params['size'] = 10;
		 //decimos el directorio a guardar el codigo qr
		$params['savename'] = FCPATH.'img/'.$folder.'/'.$nombreArchivo.'.png';
		 //generamos el código qr
		 $this->ciqrcode->generate($params); 
	 }

	//PERSONAL
	public function listaPersonal(){
		if ($this->validarSession()) {
			$data['personal'] = $this->admin_model->listarPersonal();
			$this->load->view('admin_personal_view', $data);
		}
	}
	public function seleccionarPersonal(){
		if ($this->validarSession()) {
			$id_personal = $this->input->post('id_personal');
			$data = $this->admin_model->seleccionarPersonal($id_personal);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearPersonal(){
		if ($this->validarSession()) {
			$data['nombre'] = $this->input->post('nombre');
			$data['ap_pat'] = $this->input->post('ap_pat');
			$data['ap_mat'] = $this->input->post('ap_mat');
			$data['genero'] = $this->input->post('genero');
			$data['email'] = $this->input->post('email');
			$data['telefono'] = $this->input->post('telefono');
			$data['celular'] = $this->input->post('celular');
			$data['direccion'] = $this->input->post('direccion');
			$data['ci'] = $this->input->post('ci');
			$data['expedido'] = $this->input->post('expedido');
			$data['fecha_nacimiento'] = $this->input->post('fecha_nacimiento');
			$data['fecha_inicio'] = $this->input->post('fecha_inicio');
			$data['trabajo'] = $this->input->post('trabajo');
			//$data['fecha_inicio'] = date('Y-m-d');
			$id_personal = $this->admin_model->crearPersonal($data);
			$this->generarImgQR($id_personal, 'personal', $id_personal.'_qr');
			echo json_encode(true);
		}
	}
	public function actualizarPersonal($id_personal){
		if ($this->validarSession()) {
			try{
			$data['id_personal'] = $id_personal;
			$data['nombre'] = $this->input->post('nombre');
			$data['ap_pat'] = $this->input->post('ap_pat');
			$data['ap_mat'] = $this->input->post('ap_mat');
			$data['genero'] = $this->input->post('genero');
			$data['email'] = $this->input->post('email');
			$data['telefono'] = $this->input->post('telefono');
			$data['celular'] = $this->input->post('celular');
			$data['direccion'] = $this->input->post('direccion');
			$data['ci'] = $this->input->post('ci');
			$data['expedido'] = $this->input->post('expedido');
			$data['fecha_nacimiento'] = $this->input->post('fecha_nacimiento');
			$data['fecha_inicio'] = $this->input->post('fecha_inicio');
			$data['trabajo'] = $this->input->post('trabajo');
			$this->admin_model->editarPersonal($id_personal, $data);
			$this->generarImgQR($id_personal, 'personal', $id_personal.'_qr');
			echo json_encode(true);
			}catch(Exception $e){
				echo 'error '.$e;
			}
		}
	}
	public function eliminarPersonal($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarPersonal($id);
		echo json_encode('success');
		return;
	}



	//CLIENTE
	public function listaCliente(){
		if ($this->validarSession()) {
			$data['clientes'] = $this->admin_model->listarCliente();
			$this->load->view('admin_cliente_view', $data);
			$this->load->view('admin_cliente_menu_view');
		}
	}
	public function seleccionarCliente(){
		if ($this->validarSession()) {
			$id_cliente = $this->input->post('id_cliente');
			$data = $this->admin_model->seleccionarCliente($id_cliente);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearCliente(){
		if ($this->validarSession()) {
			$data['nombre'] = $this->input->post('nombre');
			$data['ap_pat'] = $this->input->post('ap_pat');
			$data['ap_mat'] = $this->input->post('ap_mat');
			$data['fecha_nac'] = $this->input->post('fecha_nac');
			$data['ci'] = $this->input->post('ci');
			$data['expedido'] = $this->input->post('expedido');
			$data['celular'] = $this->input->post('celular');
			$data['telefono'] = $this->input->post('telefono');
			$data['preferencia'] = $this->input->post('preferencia');
			$data['observacion'] = $this->input->post('observacion');
			$id_cliente = $this->admin_model->crearCliente($data);
			$this->generarImgQR($id_cliente, 'clientes', $id_cliente.'_qr');
			echo json_encode(true);
		}
	}


}
?>
