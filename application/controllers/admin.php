<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url', 'html', 'form'));
		$this->load->model('admin_model');
	}
	
	public function index(){
		if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'admin'){
			redirect(base_url().'login');
		}
		$this->load->view('admin_view');
	}

	function validarSession() {
		if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'admin'){
			redirect(base_url().'login');
		} else {
			return true;
		}
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
			//$data['fecha_inicio'] = date('Y-m-d');
			$this->admin_model->crearPersonal($data);
			echo json_encode(true);
		}
	}
	public function actualizarPersonal($id){
		if ($this->validarSession()) {
			$data['id_personal'] = $id;
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
			$this->admin_model->editarPersonal($id, $data);
			echo json_encode(true);
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
			if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
				$data['nombre'] = $this->input->post('nombre');
				$data['precio'] = $this->input->post('precio');
				$data['precio_reserva'] = $this->input->post('precio_reserva');
				$data['puntos_cliente'] = $this->input->post('puntos_cliente');
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
				echo "Por favor seleccione un archivo";
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
			$data['producto'] = $this->admin_model->listarProducto();
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
			$data['img'] = $this->input->post('img');
			$data['cantidad'] = $this->input->post('cantidad');
			$data['precio_compra'] = $this->input->post('precio_compra');
			$data['precio_venta'] = $this->input->post('precio_venta');
			$this->admin_model->crearProducto($data);
			echo json_encode(true);
		}
	}
	public function actualizarProducto($id){
		if ($this->validarSession()) {
			$data['id_producto'] = $id;
			$data['nombre'] = $this->input->post('nombre');
			$data['codigo'] = $this->input->post('codigo');
			$data['img'] = $this->input->post('img');
			$data['precio_compra'] = $this->input->post('precio_compra');
			$data['precio_venta'] = $this->input->post('precio_venta');
			$this->admin_model->editarProducto($id, $data);
			echo json_encode(true);
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


	//RESERVAS
	public function listaReserva(){
		if ($this->validarSession()) {
			$data['reserva'] = $this->admin_model->listarReserva();
			$this->load->view('admin_reserva_view', $data);
		}
	}
	public function seleccionarReserva(){
		if ($this->validarSession()) {
			$id_reserva = $this->input->post('id_reserva');
			$data = $this->admin_model->seleccionarReserva($id_reserva);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearReserva(){
		if ($this->validarSession()) {
			$data['cantidad_bloqueo'] = $this->input->post('cantidad_bloqueo');
			$data['tiempo_recordatorio'] = $this->input->post('tiempo_recordatorio');
			$data['tiempo_cancelar'] = $this->input->post('tiempo_cancelar');
			$data['cantidad_avisos_dia'] = $this->input->post('cantidad_avisos_dia');
			$data['titulo'] = $this->input->post('titulo');
			$data['mensaje'] = $this->input->post('mensaje');
			$this->admin_model->crearReserva($data);
			echo json_encode(true);
		}
	}
	public function actualizarReserva($id){
		if ($this->validarSession()) {
			$data['id_reserva'] = $id;
			$data['cantidad_bloqueo'] = $this->input->post('cantidad_bloqueo');
			$data['tiempo_recordatorio'] = $this->input->post('tiempo_recordatorio');
			$data['tiempo_cancelar'] = $this->input->post('tiempo_cancelar');
			$data['cantidad_avisos_dia'] = $this->input->post('cantidad_avisos_dia');
			$data['titulo'] = $this->input->post('titulo');
			$data['mensaje'] = $this->input->post('mensaje');
			$this->admin_model->editarReserva($id, $data);
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

	//CLIENTE
	public function listaCliente(){
		if ($this->validarSession()) {
			$data['cliente'] = $this->admin_model->listarCliente();
			$this->load->view('admin_cliente_view', $data);
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
			$this->admin_model->crearCliente($data);
			echo json_encode(true);
		}
	}
	public function actualizarCliente($id){
		if ($this->validarSession()) {
			$data['id_cliente'] = $id;
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
			$this->admin_model->editarCliente($id, $data);
			echo json_encode(true);
		}
	}
	public function eliminarCliente($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarCliente($id);
		echo json_encode('success');
		return;
	}

	//PUNTOS
	public function listaPuntos(){
		if ($this->validarSession()) {
			$data['punto'] = $this->admin_model->listarPunto();
			$this->load->view('admin_punto_view', $data);
		}
	}
	public function seleccionarPunto(){
		if ($this->validarSession()) {
			$id_punto = $this->input->post('id_punto');
			$data = $this->admin_model->seleccionarPunto($id_punto);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearPunto(){
		if ($this->validarSession()) {
			$data['descripcion'] = $this->input->post('descripcion');
			$data['id_cliente'] = $this->input->post('id_cliente');
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
			$data['descripcion'] = $this->input->post('descripcion');
			$data['id_cliente'] = $this->input->post('id_cliente');
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
	public function listaNotificaciones(){
		if ($this->validarSession()) {
			$data['notificacion'] = $this->admin_model->listarNotificacion();
			$this->load->view('admin_notificacion_view', $data);
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

	//PROMOCION_NORMAL
	public function listaPromocionNormal(){
		if ($this->validarSession()) {
			$data['promocion_normal'] = $this->admin_model->listarPromocionNormal();
			$this->load->view('admin_promocion_normal_view', $data);
		}
	}
	public function seleccionarPromocionNormal(){
		if ($this->validarSession()) {
			$id_promocion_normal = $this->input->post('id_promocion_normal');
			$data = $this->admin_model->seleccionarPromocionNormal($id_promocion_normal);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearPromocionNormal(){
		if ($this->validarSession()) {
			$data['id_producto'] = $this->input->post('id_producto');
			$data['id_servicio'] = $this->input->post('id_servicio');
			$data['titulo'] = $this->input->post('titulo');
			$data['mensaje'] = $this->input->post('mensaje');
			$data['auto_notificar'] = $this->input->post('auto_notificar');
			$data['fecha_inicio'] = $this->input->post('fecha_inicior');
			$data['fecha_final'] = $this->input->post('fecha_final');
			$data['monto_descuento'] = $this->input->post('monto_descuento');
			$data['por_antiguedad'] = $this->input->post('por_antiguedad');
			$data['por_cumpleanios'] = $this->input->post('por_cumpleanios');
			$data['por_familiar'] = $this->input->post('por_familiar');
			$this->admin_model->crearPromocionNormal($data);
			echo json_encode(true);
		}
	}
	public function actualizarPromocionNormal($id){
		if ($this->validarSession()) {
			$data['id_producto'] = $this->input->post('id_producto');
			$data['id_servicio'] = $this->input->post('id_servicio');
			$data['titulo'] = $this->input->post('titulo');
			$data['mensaje'] = $this->input->post('mensaje');
			$data['auto_notificar'] = $this->input->post('auto_notificar');
			$data['fecha_inicio'] = $this->input->post('fecha_inicior');
			$data['fecha_final'] = $this->input->post('fecha_final');
			$data['monto_descuento'] = $this->input->post('monto_descuento');
			$data['por_antiguedad'] = $this->input->post('por_antiguedad');
			$data['por_cumpleanios'] = $this->input->post('por_cumpleanios');
			$data['por_familiar'] = $this->input->post('por_familiar');
			$this->admin_model->editarPromocionNormal($id, $data);
			echo json_encode(true);
		}
	}
	public function eliminarPromocionNormal($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarPromocionNormal($id);
		echo json_encode('success');
		return;
	}

	//PROMOCION_COMBO
	public function listaPromocionCombo(){
		if ($this->validarSession()) {
			$data['promocion_combo'] = $this->admin_model->listarPromocionCombo();
			$this->load->view('admin_promocion_combo_view', $data);
		}
	}
	public function seleccionarPromocionCombo(){
		if ($this->validarSession()) {
			$id_promocion_combo = $this->input->post('id_promocion_combo');
			$data['promocion_combo'] = $this->admin_model->seleccionarPromocionCombo($id_promocion_combo);
			$data['productos'] = $this->admin_model->seleccionarRelPromocionComboProductos($id_promocion_combo);
			$data['servicios'] = $this->admin_model->seleccionarRelPromocionComboServicios($id_promocion_combo);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearPromocionCombo(){
		if ($this->validarSession()) {
			$data['titulo'] = $this->input->post('titulo');
			$data['mensaje'] = $this->input->post('mensaje');
			$data['auto_notificar'] = $this->input->post('auto_notificar');
			$data['fecha_inicio'] = $this->input->post('fecha_inicior');
			$data['fecha_final'] = $this->input->post('fecha_final');
			$data['monto_descuento'] = $this->input->post('monto_descuento');
			$data['por_antiguedad'] = $this->input->post('por_antiguedad');
			$data['por_cumpleanios'] = $this->input->post('por_cumpleanios');
			$data['por_familiar'] = $this->input->post('por_familiar');
			$this->admin_model->crearPromocionCombo($data);
			$this->admin_model->crearRelPromocionComboProductos($this->input->post('productos'));
			$this->admin_model->crearRelPromocionComboServicios($this->input->post('servicios'));
			echo json_encode(true);
		}
	}
	public function actualizarPromocionCombo($id){
		if ($this->validarSession()) {
			$data['titulo'] = $this->input->post('titulo');
			$data['mensaje'] = $this->input->post('mensaje');
			$data['auto_notificar'] = $this->input->post('auto_notificar');
			$data['fecha_inicio'] = $this->input->post('fecha_inicior');
			$data['fecha_final'] = $this->input->post('fecha_final');
			$data['monto_descuento'] = $this->input->post('monto_descuento');
			$data['por_antiguedad'] = $this->input->post('por_antiguedad');
			$data['por_cumpleanios'] = $this->input->post('por_cumpleanios');
			$data['por_familiar'] = $this->input->post('por_familiar');
			$this->admin_model->editarPromocionCombo($id, $data);
			$this->admin_model->eliminarRelPromocionComboProductos($this->input->post('producto'));
			$this->admin_model->crearRelPromocionComboProductos($this->input->post('producto'));
			$this->admin_model->eliminarPromocionComboServicios($this->input->post('servicio'));
			$this->admin_model->crearRelPromocionComboServicios($this->input->post('servicio'));
			echo json_encode(true);
		}
	}
	public function eliminarPromocionCombo($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarPromocionCombo($id);
		echo json_encode('success');
		return;
	}

	//CONFIGURACION_CLIENTE
	public function listaConfiguracionCliente(){
		if ($this->validarSession()) {
			$data['configuracion_cliente'] = $this->admin_model->listarConfiguracionCliente();
			$this->load->view('admin_configuracion_cliente_view', $data);
		}
	}
	public function seleccionarConfiguracionCliente(){
		if ($this->validarSession()) {
			$id_configuracion_cliente = $this->input->post('id_configuracion_cliente');
			$data['configuracion_cliente'] = $this->admin_model->seleccionarConfiguracionCliente($id_configuracion_cliente);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	public function crearConfiguracionCliente(){
		if ($this->validarSession()) {
			$data['meses_antiguedad'] = $this->input->post('meses_antiguedad');
			$data['cantidad_dependientes'] = $this->input->post('cantidad_dependientes');
			$this->admin_model->crearConfiguracionClienteon($data);
			echo json_encode(true);
		}
	}
	public function actualizarConfiguracionCliente($id){
		if ($this->validarSession()) {
			$data['meses_antiguedad'] = $this->input->post('meses_antiguedad');
			$data['cantidad_dependientes'] = $this->input->post('cantidad_dependientes');
			$this->admin_model->editarConfiguracionCliente($id, $data);
			echo json_encode(true);
		}
	}
	public function eliminarConfiguracionCliente($id){
		if ($id == NULL OR !is_numeric($id)){
			echo json_encode('error');
			return;
		}
		$this->admin_model->eliminarConfiguracionCliente($id);
		echo json_encode('success');
		return;
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
/*
	public function insertarVideo(){
		$this->load->view('insertar_video_view');
	}
	public function crearVideo(){
		$dataArchivo['titulo'] = $this->input->post('nombre');
		$dataArchivo['ruta'] = $this->input->post('fecha');
		$this->pantalla_model->crearAdministrador($dataAdmin);
		redirect(base_url().'index.php/pantalla/listaArchivo?save=true');
	}
	public function editarConfiguracion($id){
		$data['configuracion'] = $this->pantalla_model->seleccionarConfiguracion($id)[0];
		$this->load->view('editar_configuracion_view', $data);
	}
	public function actualizarConfiguracion($id){
		$data['tiempo_imagenes'] = $this->input->post('tiempo_imagenes');
		$data['tiempo_panel'] = $this->input->post('tiempo_panel');
		$data['tiempo_sub_panel'] = $this->input->post('tiempo_sub_panel');
		$this->pantalla_model->editarConfiguracion($id, $data);
		redirect(base_url().'index.php/pantalla/listaConfiguracion?update=true');
	}
*/

/*
	public function insertarPersonal(){
		if ($this->validarSession()) {
			$data['estudiantes'] = $this->amsdmams_model->listarEstudiante();
			$this->load->view('insertar_docente_blog_est_view', $data);
		}
	}
	public function editarPersonal($id){
		if ($this->validarSession()) {
			$data['blog_estudiante'] = $this->usuario_model->seleccionarBlogEstudiante($id)[0];
			$this->load->view('editar_docente_blog_est_view', $data);
		}
	}
*/
}
?>
