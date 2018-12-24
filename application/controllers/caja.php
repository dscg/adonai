<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Caja extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
//		$this->load->library(array('session','form_validation'));
//		$this->load->helper(array('url','form'));
//		$this->load->database('default');
	}
	
	public function index(){
		if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'caja'){
			redirect(base_url().'login');
		}
		$this->load->view('caja_view');
	}

	function validarSession() {
		if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'caja'){
			redirect(base_url().'login');
		} else {
			return true;
		}
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

	//APERTURA CAJA
 	public function aperturaCaja(){
		if ($this->validarSession()) {
			$this->load->view('caja_apertura_view');
		}
	}
	//CIERRE CAJA
 	public function cierreCaja(){
		if ($this->validarSession()) {
			$this->load->view('caja_cierre_view');
		}
	}

	//CLIENTE
	public function listaCliente(){
		if ($this->validarSession()) {
			$data['clientes'] = $this->admin_model->listarCliente();
			$this->load->view('caja_lista_clientes_adonai_view', $data);
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
	public function registrarCliente(){
		if ($this->validarSession()) {
			$this->load->view('caja_registrar_cliente_view');
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
			$this->generarImgQR($id_cliente, 'cliente', $id_cliente.'_qr');
			echo json_encode(true);
		}
	}



	//PERSONAL
	public function listaPersonal(){
		if ($this->validarSession()) {
			$data['personal'] = $this->admin_model->listarPersonal();
			$data['clientes'] = $this->admin_model->listarCliente();
			$this->load->view('admin_personal_view', $data);
			$this->load->view('admin_personal_menu_view', $data);
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
			$dataUsuario['user'] = $this->input->post('user');
			$dataUsuario['pass'] = $this->input->post('pass');
			$dataUsuario['tipo'] = $this->input->post('trabajo');
			//$data['fecha_inicio'] = date('Y-m-d');
			$id_usuario = $this->admin_model->crearUsuario($dataUsuario);
			$data['id_usuario'] = $id_usuario;
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
			$dataUsuario['user'] = $this->input->post('user');
			$dataUsuario['pass'] = $this->input->post('pass');
			$dataUsuario['tipo'] = $this->input->post('trabajo');;
			$this->admin_model->editarPersonal($id_personal, $data);
			$this->admin_model->editarUsuario($this->input->post('id_usuario'), $dataUsuario);
			if($this->input->post('generar_qr') == 'Si'){
				$this->generarImgQR($id_personal, 'personal', $id_personal.'_qr');
			}
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
		$this->admin_model->eliminarUsuario($this->input->post('id_usuario'));
		echo json_encode('success');
		return;
	}

	//PUESTO
	public function listaPuesto(){
		if ($this->validarSession()) {
			$data['puestos'] = $this->admin_model->listarPuesto();
			$this->load->view('admin_puesto_view', $data);
			$this->load->view('admin_personal_menu_view', $data);
		}
	}
	public function seleccionarPuesto(){
		if ($this->validarSession()) {
			$id_puesto = $this->input->post('id_puesto');
			$data = $this->admin_model->seleccionarPuesto($id_puesto);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearPuesto(){
		if ($this->validarSession()) {
			$data['nombre'] = $this->input->post('nombre');
			$data['numero'] = $this->input->post('numero');
			$data['tipo'] = $this->input->post('tipo');
			if ($this->input->post('exist_file')=='si' && isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
				unset($config);
				$date = date("ymd");
				$configPuesto['max_size'] = '0';// 0 no limit in bytes this field
				$configPuesto['overwrite'] = FALSE;
				$configPuesto['remove_spaces'] = TRUE;
				$configPuesto['file_name'] = $date.$_FILES['file']['name'];
				$configPuesto['upload_path'] = './img/puesto';
				$configPuesto['allowed_types'] = 'gif|jpg|png|mp4|webm|avi|flv';
				$this->load->library('upload', $configPuesto);
				$this->upload->initialize($configPuesto);
				if (!$this->upload->do_upload('file')) { #Aquí me refiero a "foto", el nombre que pusimos en FormData
					$error = array('error' => $this->upload->display_errors());
					echo json_encode($error);
				} else {
					$file_info = $this->upload->data();
					$data['img'] = $file_info['file_name'];
					$this->admin_model->crearPuesto($data);
					echo json_encode(true);
				}
			}else{
				$this->admin_model->crearPuesto($data);
				echo json_encode(true);
			}

		}
	}
	public function actualizarPuesto($id_puesto){
		if ($this->validarSession()) {
			$data['id_puesto'] = $id_puesto;
			$data['nombre'] = $this->input->post('nombre');
			$data['numero'] = $this->input->post('numero');
			$data['tipo'] = $this->input->post('tipo');
			if ($this->input->post('exist_file')=='si' && isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
				unset($config);
				$date = date("ymd");
				$configPuesto['max_size'] = '0';// 0 no limit in bytes this field
				$configPuesto['overwrite'] = FALSE;
				$configPuesto['remove_spaces'] = TRUE;
				$configPuesto['file_name'] = $date.$_FILES['file']['name'];
				$configPuesto['upload_path'] = './img/puesto';
				$configPuesto['allowed_types'] = 'gif|jpg|png|mp4|webm|avi|flv';
				$this->load->library('upload', $configPuesto);
				$this->upload->initialize($configPuesto);
				if (!$this->upload->do_upload('file')) { #Aquí me refiero a "foto", el nombre que pusimos en FormData
					$error = array('error' => $this->upload->display_errors());
					echo json_encode($error);
				} else {
					$file_info = $this->upload->data();
					$data['img'] = $file_info['file_name'];
					$this->admin_model->editarPuesto($id_puesto, $data);
					echo json_encode(true);
				}
			}else{
				$this->admin_model->editarPuesto($id_puesto, $data);
				echo json_encode(true);
			}


		}
	}
	public function eliminarPuesto($id_puesto){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarPuesto($id_puesto);
		echo json_encode('success');
		return;
	}

	//SERVICIO
	public function listaServicio(){
		if ($this->validarSession()) {
			$data['servicios'] = $this->admin_model->listarServicio();
			$this->load->view('admin_servicio_view', $data);
		}
	}
	public function seleccionarServicio(){
		if ($this->validarSession()) {
			$id_servicio = $this->input->post('id_servicio');
			$data = $this->admin_model->seleccionarServicio($id_servicio);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearServicio(){
		if ($this->validarSession()) {
			$data['nombre'] = $this->input->post('nombre');
			$data['precio'] = $this->input->post('precio');
			$data['precio_reserva'] = $this->input->post('precio_reserva');
			$data['puntos_cliente'] = $this->input->post('puntos_cliente');
			if ($this->input->post('exist_file')=='si' && isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
				unset($config);
				$date = date("ymd");
				$configServicio['max_size'] = '0';// 0 no limit in bytes this field
				$configServicio['overwrite'] = FALSE;
				$configServicio['remove_spaces'] = TRUE;
				$configServicio['file_name'] = $date.$_FILES['file']['name'];
				$configServicio['upload_path'] = './img/servicio';
				$configServicio['allowed_types'] = 'gif|jpg|png|mp4|webm|avi|flv';
				$this->load->library('upload', $configServicio);
				$this->upload->initialize($configServicio);
				if (!$this->upload->do_upload('file')) { #Aquí me refiero a "foto", el nombre que pusimos en FormData
					$error = array('error' => $this->upload->display_errors());
					echo json_encode($error);
				} else {
					$file_info = $this->upload->data();
					$data['img'] = $file_info['file_name'];
					$this->admin_model->crearServicio($data);
					echo json_encode(true);
				}
			}else{
				$this->admin_model->crearServicio($data);
				echo json_encode(true);
			}
		}
	}
	public function actualizarServicio($id){
		if ($this->validarSession()) {
			$data['id_servicio'] = $id;
			$data['nombre'] = $this->input->post('nombre');
			$data['precio'] = $this->input->post('precio');
			$data['precio_reserva'] = $this->input->post('precio_reserva');
			$data['puntos_cliente'] = $this->input->post('puntos_cliente');
			if ($this->input->post('exist_file')=='si' && isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
				unset($config);
				$date = date("ymd");
				$configServicio['max_size'] = '0';// 0 no limit in bytes this field
				$configServicio['overwrite'] = FALSE;
				$configServicio['remove_spaces'] = TRUE;
				$configServicio['file_name'] = $date.$_FILES['file']['name'];
				$configServicio['upload_path'] = './img/servicio';
				$configServicio['allowed_types'] = 'gif|jpg|png|mp4|webm|avi|flv';
				$this->load->library('upload', $configServicio);
				$this->upload->initialize($configServicio);
				if (!$this->upload->do_upload('file')) { #Aquí me refiero a "foto", el nombre que pusimos en FormData
					$error = array('error' => $this->upload->display_errors());
					echo json_encode($error);
				} else {
					$file_info = $this->upload->data();
					$data['img'] = $file_info['file_name'];
					$this->admin_model->editarServicio($id, $data);
					echo json_encode(true);
				}
			}else{
				$this->admin_model->editarServicio($id, $data);
				echo json_encode(true);
			}
		}
	}
	public function eliminarServicio($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarServicio($id);
		echo json_encode('success');
		return;
	}

	//PRODUCTO
	public function listaProducto(){
		if ($this->validarSession()) {
			$data['productos'] = $this->admin_model->listarProducto();
			$this->load->view('admin_producto_view', $data);
		}
	}
	public function seleccionarProducto(){
		if ($this->validarSession()) {
			$id_producto = $this->input->post('id_producto');
			$data = $this->admin_model->seleccionarProducto($id_producto);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearProducto(){
		if ($this->validarSession()) {
			$data['nombre'] = $this->input->post('nombre');
			$data['codigo'] = $this->input->post('codigo');
			$data['cantidad'] = $this->input->post('cantidad');
			$data['precio_compra'] = $this->input->post('precio_compra');
			$data['precio_venta'] = $this->input->post('precio_venta');
			if ($this->input->post('exist_file')=='si' && isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
				unset($config);
				$date = date("ymd");
				$configProducto['max_size'] = '0';// 0 no limit in bytes this field
				$configProducto['overwrite'] = FALSE;
				$configProducto['remove_spaces'] = TRUE;
				$configProducto['file_name'] = $date.$_FILES['file']['name'];
				$configProducto['upload_path'] = './img/producto';
				$configProducto['allowed_types'] = 'gif|jpg|png|mp4|webm|avi|flv';
				$this->load->library('upload', $configProducto);
				$this->upload->initialize($configProducto);
				if (!$this->upload->do_upload('file')) { #Aquí me refiero a "foto", el nombre que pusimos en FormData
					$error = array('error' => $this->upload->display_errors());
					echo json_encode($error);
				} else {
					$file_info = $this->upload->data();
					$data['img'] = $file_info['file_name'];
					$this->admin_model->crearProducto($data);
					echo json_encode(true);
				}
			}else{
				$this->admin_model->crearProducto($data);
				echo json_encode(true);
			}
		}
	}
	public function actualizarProducto($id){
		if ($this->validarSession()) {
			$data['id_producto'] = $id;
			$data['nombre'] = $this->input->post('nombre');
			$data['codigo'] = $this->input->post('codigo');
			$data['cantidad'] = $this->input->post('cantidad');
			$data['precio_compra'] = $this->input->post('precio_compra');
			$data['precio_venta'] = $this->input->post('precio_venta');
			if ($this->input->post('exist_file')=='si' && isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
				unset($config);
				$date = date("ymd");
				$configProducto['max_size'] = '0';// 0 no limit in bytes this field
				$configProducto['overwrite'] = FALSE;
				$configProducto['remove_spaces'] = TRUE;
				$configProducto['file_name'] = $date.$_FILES['file']['name'];
				$configProducto['upload_path'] = './img/producto';
				$configProducto['allowed_types'] = 'gif|jpg|png|mp4|webm|avi|flv';
				$this->load->library('upload', $configProducto);
				$this->upload->initialize($configProducto);
				if (!$this->upload->do_upload('file')) { #Aquí me refiero a "foto", el nombre que pusimos en FormData
					$error = array('error' => $this->upload->display_errors());
					echo json_encode($error);
				} else {
					$file_info = $this->upload->data();
					$data['img'] = $file_info['file_name'];
					$this->admin_model->editarProducto($id, $data);
					echo json_encode(true);
				}
			}else{
				$this->admin_model->editarProducto($id, $data);
				echo json_encode(true);
			}
		}
	}
	public function eliminarProducto($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarProducto($id);
		echo json_encode('success');
		return;
	}


	//ASOCIADOS
	public function listaAsociado(){
		if ($this->validarSession()) {
			$data['asociados'] = $this->admin_model->listarAsociado();
			$this->load->view('admin_asociado_view', $data);
			$this->load->view('admin_cliente_menu_view');
		}
	}
	public function seleccionarAsociado(){
		if ($this->validarSession()) {
			$id_asociado = $this->input->post('id_asociado');
			$data = $this->admin_model->seleccionarAsociado($id_asociado);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearAsociado(){
		if ($this->validarSession()) {
			$data['nombre'] = $this->input->post('nombre');
			$data['fecha_inicio'] = $this->input->post('fecha_inicio');
			$data['fecha_final'] = $this->input->post('fecha_final');
			$data['total_integrantes'] = $this->input->post('total_integrantes');
			$this->admin_model->crearAsociado($data);
			echo json_encode(true);
		}
	}
	public function actualizarAsociado($id){
		if ($this->validarSession()) {
			$data['nombre'] = $this->input->post('nombre');
			$data['fecha_inicio'] = $this->input->post('fecha_inicio');
			$data['fecha_final'] = $this->input->post('fecha_final');
			$data['total_integrantes'] = $this->input->post('total_integrantes');
			$this->admin_model->editarAsociado($id, $data);
			echo json_encode(true);
		}
	}
	public function eliminarAsociado($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarAsociado($id);
		echo json_encode('success');
		return;
	}

	//CUENTA INTERNA CLIENTE
	public function listaCuentaInternaCliente(){
		if ($this->validarSession()) {
			$data['cuentas_internas'] = $this->admin_model->listarCuentaInternaCliente();
			$data['clientes'] = $this->admin_model->listarCliente();
			$data['productos'] = $this->admin_model->listarProducto();
			$data['servicios'] = $this->admin_model->listarServicio();
			$this->load->view('admin_cuenta_interna_cliente_view', $data);
			$this->load->view('admin_cliente_menu_view');
		}
	}
	public function seleccionarCuentaInternaCliente(){
		if ($this->validarSession()) {
			$id_cuenta_interna_cliente = $this->input->post('id_cuenta_interna_cliente');
			$data['cuenta_interna_cliente'] = $this->admin_model->seleccionarCuentaInternaCliente($id_cuenta_interna_cliente);
			$data['clientes'] = $this->admin_model->listarCliente();
			$data['productos'] = $this->admin_model->listarProducto();
			$data['servicios'] = $this->admin_model->listarServicio();
			$data['cuenta_interna_cliente_productos'] = $this->admin_model->seleccionarRelCuentaInternaClienteProductos($id_cuenta_interna_cliente);
			$data['cuenta_interna_cliente_servicios'] = $this->admin_model->seleccionarRelCuentaInternaClienteServicios($id_cuenta_interna_cliente);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearCuentaInternaCliente(){
		if ($this->validarSession()) {
			$data['id_cliente'] = $this->input->post('id_cliente');
			$data['monto'] = $this->input->post('monto');
			$data['fecha_ingreso'] = $this->input->post('fecha_ingreso');
			$productos = json_decode($this->input->post('productos'));
			$servicios = json_decode($this->input->post('servicios'));
			$id_cuenta_interna_cliente = $this->admin_model->crearCuentaInternaCliente($data);
			foreach($productos as $producto){
				$data_prd['id_cuenta_interna_cliente'] = $id_cuenta_interna_cliente;
				$data_prd['id_producto'] = $producto->id_producto;
				$data_prd['cantidad'] = $producto->cantidad;
				$this->admin_model->crearRelCuentaInternaClienteProductos($data_prd);
			}
			foreach($servicios as $servicio){
				$data_srv['id_cuenta_interna_cliente'] = $id_cuenta_interna_cliente;
				$data_srv['id_servicio'] = $servicio->id_servicio;
				$data_srv['cantidad'] = $servicio->cantidad;
				$this->admin_model->crearRelCuentaInternaClienteServicios($data_srv);
			}
			echo json_encode(true);
		}
	}
	public function actualizarCuentaInternaCliente($id_cuenta_interna_cliente){
		if ($this->validarSession()) {
			$data['id_cliente'] = $this->input->post('id_cliente');
			$data['monto'] = $this->input->post('monto');
			$data['fecha_ingreso'] = $this->input->post('fecha_ingreso');
			$productos = json_decode($this->input->post('productos'));
			$servicios = json_decode($this->input->post('servicios'));
			$this->admin_model->editarCuentaInternaCliente($id_cuenta_interna_cliente, $data);
			$this->admin_model->eliminarRelCuentaInternaClienteProductos($id_cuenta_interna_cliente);
			$this->admin_model->eliminarRelCuentaInternaClienteServicios($id_cuenta_interna_cliente);
			foreach($productos as $producto){
				$data_prd['id_cuenta_interna_cliente'] = $id_cuenta_interna_cliente;
				$data_prd['id_producto'] = $producto->id_producto;
				$data_prd['cantidad'] = $producto->cantidad;
				$this->admin_model->crearRelCuentaInternaClienteProductos($data_prd);
			}
			foreach($servicios as $servicio){
				$data_srv['id_cuenta_interna_cliente'] = $id_cuenta_interna_cliente;
				$data_srv['id_servicio'] = $servicio->id_servicio;
				$data_srv['cantidad'] = $servicio->cantidad;
				$this->admin_model->crearRelCuentaInternaClienteServicios($data_srv);
			}
			echo json_encode(true);
		}
	}
	public function eliminarCuentaInternaCliente($id_cuenta_interna_cliente){
		if ($id == NULL OR !is_numeric($id_cuenta_interna_cliente)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarRelCuentaInternaClienteProductos($id_cuenta_interna_cliente);
		$this->admin_model->eliminarRelCuentaInternaClienteServicios($id_cuenta_interna_cliente);
		$this->admin_model->eliminarCuentaInternaCliente($id_cuenta_interna_cliente);
		echo json_encode('success');
		return;
	}

	//PUNTOS
	public function listaPunto(){
		if ($this->validarSession()) {
			$data['puntos'] = $this->admin_model->listarPunto();
			$data['clientes'] = $this->admin_model->listarCliente();
			$this->load->view('admin_punto_view', $data);
			$this->load->view('admin_cliente_menu_view');
		}
	}
	public function seleccionarPunto(){
		if ($this->validarSession()) {
			$id_punto = $this->input->post('id_punto');
			$data['clientes'] = $this->admin_model->listarCliente();
			$data['punto'] = $this->admin_model->seleccionarPunto($id_punto);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearPunto(){
		if ($this->validarSession()) {
			$data['id_cliente'] = $this->input->post('id_cliente');
			$data['descripcion'] = $this->input->post('descripcion');
			$data['cantidad'] = $this->input->post('cantidad');
			$data['estado'] = $this->input->post('estado');
			$data['fecha_registro'] = $this->input->post('fecha_registro');
			$data['fecha_asignacion'] = $this->input->post('fecha_asignacion');
			$this->admin_model->crearPunto($data);
			echo json_encode(true);
		}
	}
	public function actualizarPunto($id){
		if ($this->validarSession()) {
			$data['id_punto'] = $id;
			$data['id_cliente'] = $this->input->post('id_cliente');
			$data['descripcion'] = $this->input->post('descripcion');
			$data['cantidad'] = $this->input->post('cantidad');
			$data['estado'] = $this->input->post('estado');
			$data['fecha_registro'] = $this->input->post('fecha_registro');
			$data['fecha_asignacion'] = $this->input->post('fecha_asignacion');
			$this->admin_model->editarPunto($id, $data);
			echo json_encode(true);
		}
	}
	public function eliminarPunto($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarPunto($id);
		echo json_encode('success');
		return;
	}

	//NOTIFICACIONES
	public function listaNotificacion(){
		if ($this->validarSession()) {
			$data['notificaciones'] = $this->admin_model->listarNotificacion();
			$this->load->view('admin_notificacion_view', $data);
			$this->load->view('admin_cliente_menu_view', $data);
		}
	}
	public function seleccionarNotificacion(){
		if ($this->validarSession()) {
			$id_notificacion = $this->input->post('id_notificacion');
			$data = $this->admin_model->seleccionarNotificacion($id_notificacion);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearNotificacion(){
		if ($this->validarSession()) {
			$data['titulo'] = $this->input->post('titulo');
			$data['mensaje'] = $this->input->post('mensaje');
			$data['cantidad_avisos_dia'] = $this->input->post('cantidad_avisos_dia');
			$data['fecha_inicio'] = $this->input->post('fecha_inicio');
			$data['fecha_final'] = $this->input->post('fecha_final');
			$this->admin_model->crearNotificacion($data);
			echo json_encode(true);
		}
	}
	public function actualizarNotificacion($id){
		if ($this->validarSession()) {
			$data['id_notificacion'] = $id;
			$data['titulo'] = $this->input->post('titulo');
			$data['mensaje'] = $this->input->post('mensaje');
			$data['cantidad_avisos_dia'] = $this->input->post('cantidad_avisos_dia');
			$data['fecha_inicio'] = $this->input->post('fecha_inicio');
			$data['fecha_final'] = $this->input->post('fecha_final');
			$this->admin_model->editarNotificacion($id, $data);
			echo json_encode(true);
		}
	}
	public function eliminarNotificacion($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarNotificacion($id);
		echo json_encode('success');
		return;
	}

	//PROMOCIONES
	public function listaPromocion(){
		if ($this->validarSession()) {
			$data['promociones'] = $this->admin_model->listarPromocion();
			$data['productos'] = $this->admin_model->listarProducto();
			$data['servicios'] = $this->admin_model->listarServicio();
			$data['asociados'] = $this->admin_model->listarAsociado();
			$this->load->view('admin_promocion_view', $data);
			$this->load->view('admin_cliente_menu_view', $data);
		}
	}
	public function seleccionarPromocion(){
		if ($this->validarSession()) {
			$id_promocion = $this->input->post('id_promocion');
			$data['promocion'] = $this->admin_model->seleccionarPromocion($id_promocion);
			$data['asociados'] = $this->admin_model->listarAsociado();
			$data['productos'] = $this->admin_model->listarProducto();
			$data['servicios'] = $this->admin_model->listarServicio();
			$data['promocion_productos'] = $this->admin_model->seleccionarRelPromocionProductos($id_promocion);
			$data['promocion_servicios'] = $this->admin_model->seleccionarRelPromocionServicios($id_promocion);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearPromocion(){
		if ($this->validarSession()) {
			$data['id_asociado'] = $this->input->post('id_asociado');
			$data['titulo'] = $this->input->post('titulo');
			$data['mensaje'] = $this->input->post('mensaje');
			$data['auto_notificar'] = $this->input->post('auto_notificar');
			$data['fecha_inicio'] = $this->input->post('fecha_inicio');
			$data['fecha_final'] = $this->input->post('fecha_final');
			$data['monto_descuento'] = $this->input->post('monto_descuento');
			$data['por_antiguedad'] = $this->input->post('por_antiguedad');
			$data['por_cumpleanios'] = $this->input->post('por_cumpleanios');
			$data['por_familiar'] = $this->input->post('por_familiar');
			$productos = json_decode($this->input->post('productos'));
			$servicios = json_decode($this->input->post('servicios'));
			$id_promocion = $this->admin_model->crearPromocion($data);
			foreach($productos as $producto){
				$data_prd['id_promocion'] = $id_promocion;
				$data_prd['id_producto'] = $producto->id_producto;
				$data_prd['cantidad'] = $producto->cantidad;
				$this->admin_model->crearRelPromocionProductos($data_prd);
			}
			foreach($servicios as $servicio){
				$data_srv['id_promocion'] = $id_promocion;
				$data_srv['id_servicio'] = $servicio->id_servicio;
				$data_srv['cantidad'] = $servicio->cantidad;
				$this->admin_model->crearRelPromocionServicios($data_srv);
			}
			echo json_encode(true);
		}
	}
	public function actualizarPromocion($id_promocion){
		if ($this->validarSession()) {
			$data['id_asociado'] = $this->input->post('id_asociado');
			$data['titulo'] = $this->input->post('titulo');
			$data['mensaje'] = $this->input->post('mensaje');
			$data['auto_notificar'] = $this->input->post('auto_notificar');
			$data['fecha_inicio'] = $this->input->post('fecha_inicio');
			$data['fecha_final'] = $this->input->post('fecha_final');
			$data['monto_descuento'] = $this->input->post('monto_descuento');
			$data['por_antiguedad'] = $this->input->post('por_antiguedad');
			$data['por_cumpleanios'] = $this->input->post('por_cumpleanios');
			$data['por_familiar'] = $this->input->post('por_familiar');
			$this->admin_model->editarPromocion($id_promocion, $data);
			$productos = json_decode($this->input->post('productos'));
			$servicios = json_decode($this->input->post('servicios'));
			$this->admin_model->eliminarRelPromocionProductos($id_promocion);
			$this->admin_model->eliminarRelPromocionServicios($id_promocion);
			foreach($productos as $producto){
				$data_prd['id_promocion'] = $id_promocion;
				$data_prd['id_producto'] = $producto->id_producto;
				$data_prd['cantidad'] = $producto->cantidad;
				$this->admin_model->crearRelPromocionProductos($data_prd);
			}
			foreach($servicios as $servicio){
				$data_srv['id_promocion'] = $id_promocion;
				$data_srv['id_servicio'] = $servicio->id_servicio;
				$data_srv['cantidad'] = $servicio->cantidad;
				$this->admin_model->crearRelPromocionServicios($data_srv);
			}

			echo json_encode(true);
		}
	}
	public function eliminarPromocion($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarRelPromocionProductos($id);
		$this->admin_model->eliminarPromocionServicios($id);
		$this->admin_model->eliminarPromocion($id);
		echo json_encode('success');
		return;
	}

	//RESERVAS
	public function listaReserva(){
		if ($this->validarSession()) {
			$data['clientes'] = $this->admin_model->listarCliente();
			$data['puestos'] = $this->admin_model->listarPuesto();
			$data['servicios'] = $this->admin_model->listarServicio();
			$data['reservas'] = $this->admin_model->listarReserva();
			$this->load->view('admin_reserva_view', $data);
			$this->load->view('admin_cliente_menu_view');
		}
	}
	public function seleccionarReserva(){
		if ($this->validarSession()) {
			$id_reserva = $this->input->post('id_reserva');
			$data['reserva'] = $this->admin_model->seleccionarReserva($id_reserva);
			$data['clientes'] = $this->admin_model->listarCliente();
			$data['puestos'] = $this->admin_model->listarPuesto();
			$data['servicios'] = $this->admin_model->listarServicio();
			$data['reserva_servicios'] = $this->admin_model->seleccionarRelReservaServicios($id_reserva);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearReserva(){
		if ($this->validarSession()) {
			$data['id_cliente'] = $this->input->post('id_cliente');
			$data['id_puesto'] = $this->input->post('id_puesto');
			$data['fecha'] = $this->input->post('fecha');
			$data['hora'] = $this->input->post('hora');
			$data['estado'] = $this->input->post('estado');
			$id_reserva = $this->admin_model->crearReserva($data);
			$servicios = json_decode($this->input->post('servicios'));
			foreach($servicios as $servicio){
				$data_srv['id_reserva'] = $id_reserva;
				$data_srv['id_servicio'] = $servicio->id_servicio;
				$this->admin_model->crearRelReservaServicios($data_srv);
			}
			echo json_encode(true);
		}
	}
	public function actualizarReserva($id_reserva){
		if ($this->validarSession()) {
			$data['id_reserva'] = $id_reserva;
			$data['id_cliente'] = $this->input->post('id_cliente');
			$data['id_puesto'] = $this->input->post('id_puesto');
			$data['fecha'] = $this->input->post('fecha');
			$data['hora'] = $this->input->post('hora');
			$data['estado'] = $this->input->post('estado');
			$this->admin_model->editarReserva($id_reserva, $data);
			$this->admin_model->eliminarReservaServicios($id_reserva);
			$servicios = json_decode($this->input->post('servicios'));
			foreach($servicios as $servicio){
				$data_srv['id_reserva'] = $id_reserva;
				$data_srv['id_servicio'] = $servicio->id_servicio;
				$this->admin_model->crearRelReservaServicios($data_srv);
			}
			echo json_encode(true);
		}
	}
	public function eliminarReserva($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarReserva($id);
		echo json_encode('success');
		return;
	}

	//CONFIGURACION_CLIENTE
	public function listaConfiguracion(){
		if ($this->validarSession()) {
			$data['configuraciones'] = $this->admin_model->listarConfiguracionCliente();
			$this->load->view('admin_cliente_configuracion_view', $data);
			$this->load->view('admin_cliente_menu_view', $data);
		}
	}
	public function seleccionarConfiguracion(){
		if ($this->validarSession()) {
			$id_configuracion_cliente = $this->input->post('id_configuracion');
			$data = $this->admin_model->seleccionarConfiguracionCliente($id_configuracion_cliente);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function actualizarConfiguracion($id){
		if ($this->validarSession()) {
			$data['prom_meses_antiguedad'] = $this->input->post('prom_meses_antiguedad');
			$data['prom_cantidad_dependientes'] = $this->input->post('prom_cantidad_dependientes');
			$data['res_cantidad_bloqueo'] = $this->input->post('res_cantidad_bloqueo');
			$data['res_tiempo_recordatorio'] = $this->input->post('res_tiempo_recordatorio');
			$data['res_tiempo_cancelar'] = $this->input->post('res_tiempo_cancelar');
			$data['res_cantidad_avisos_dia'] = $this->input->post('res_cantidad_avisos_dia');
			$data['res_titulo'] = $this->input->post('res_titulo');
			$data['res_mensaje'] = $this->input->post('res_mensaje');
			$this->admin_model->editarConfiguracionCliente($id, $data);
			echo json_encode(true);
		}
	}

	 // VIDEO
	public function listaVideo(){
		$data['videos'] = $this->admin_model->listarVideo();
		$this->load->view('admin_video_view', $data);
//        $this->load->view('admin_video_view');
	}
	public function eliminarVideo($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarVideo($id);
		echo json_encode('success');
		return;
	}
	public function subirVideo(){
		if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
			unset($config);
			$date = date("ymd");
			$configVideo['max_size'] = '0';// 0 no limit in bytes this field
			$configVideo['overwrite'] = FALSE;
			$configVideo['remove_spaces'] = TRUE;
			$video_name = $date.$_FILES['file']['name'];
			$configVideo['file_name'] = $video_name;
			$configVideo['upload_path'] = './video';
			$configVideo['allowed_types'] = 'gif|jpg|png|mp4|webm|avi|flv';
			$ruta_video_duplicado = $this->admin_model->existeVideo($video_name);
			if ($ruta_video_duplicado == $video_name) {
				echo "existe_video";
				exit();
			}
			$this->load->library('upload', $configVideo);
			$this->upload->initialize($configVideo);
			if (!$this->upload->do_upload('file')) { #Aquí me refiero a "foto", el nombre que pusimos en FormData
				$error = array('error' => $this->upload->display_errors());
				echo json_encode($error);
			} else {
				$file_info = $this->upload->data();
				$data['ruta'] = $file_info['file_name'];
				$data['titulo'] = $this->input->post('title');
				$this->admin_model->insertarVideo($data);
				echo json_encode(true);
			}
	//		redirect(base_url().'admin');
		}else{
			echo "Por favor seleccione un archivo";
		}

	}

}
