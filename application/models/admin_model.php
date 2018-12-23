<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Admin_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	//Usuario
	public function listarUsuario(){
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->order_by('id_usuario desc');
		return $this->db->get()->result();
	}
	public function seleccionarUsuario($id){
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where("id_usuario = ".$id);
		$this->db->order_by('id_usuario asc');
		return $this->db->get()->result();
	}
    public function crearUsuario($data){
        $res = $this->db->insert('usuario', $data);
		return $this->db->insert_id();
    }
    public function editarUsuario($id, $data){
		$this->db->where('id_usuario',$id);
		$this->db->update('usuario',$data);
    }
	public function eliminarUsuario($id){
		$data = 'success';
		$this->db->where('id_usuario',$id);
		$this->db->delete('usuario');
		if($data = $this->db->_error_message());
		return $data;
	}

	//Personal
	public function listarPersonal(){
		$this->db->select('*');
		$this->db->from('personal');
        $this->db->join('usuario', 'usuario.id_usuario = personal.id_usuario');
		$this->db->order_by('id_personal desc');
		return $this->db->get()->result();
	}
	public function seleccionarPersonal($id){
		$this->db->select('*');
		$this->db->from('personal');
		$this->db->where("id_personal = ".$id);
        $this->db->join('usuario', 'usuario.id_usuario = personal.id_usuario');
		$this->db->order_by('id_personal asc');
		return $this->db->get()->result();
	}
    public function crearPersonal($data){
        $res = $this->db->insert('personal', $data);
		return $this->db->insert_id();
    }
    public function editarPersonal($id, $data){
		$this->db->where('id_personal',$id);
		$this->db->update('personal',$data);
    }
	public function eliminarPersonal($id){
		$data = 'success';
		$this->db->where('id_personal',$id);
		$this->db->delete('personal');
		if($data = $this->db->_error_message());
		return $data;
	}

	//Puesto
	public function listarPuesto(){
		$this->db->select('*');
		$this->db->from('puesto');
		$this->db->order_by('id_puesto desc');
		return $this->db->get()->result();
	}
	public function seleccionarPuesto($id){
		$this->db->select('*');
		$this->db->from('puesto');
		$this->db->where("id_puesto = ".$id);
		$this->db->order_by('id_puesto asc');
		return $this->db->get()->result();
	}
    public function crearPuesto($data){
        $res = $this->db->insert('puesto', $data);
		return $this->db->insert_id();
    }
    public function editarPuesto($id, $data){
		$this->db->where('id_puesto',$id);
		$this->db->update('puesto',$data);
    }
	public function eliminarPuesto($id){
		$data = 'success';
		$this->db->where('id_puesto',$id);
		$this->db->delete('puesto');
		if($data = $this->db->_error_message());
		return $data;
	}

	//Servicio
	public function listarServicio(){
		$this->db->select('*');
		$this->db->from('servicio');
		$this->db->order_by('id_servicio desc');
		return $this->db->get()->result();
	}
	public function seleccionarServicio($id){
		$this->db->select('*');
		$this->db->from('servicio');
		$this->db->where("id_servicio = ".$id);
		$this->db->order_by('id_servicio asc');
		return $this->db->get()->result();
	}
    public function crearServicio($data){
        $res = $this->db->insert('servicio', $data);
		return $this->db->insert_id();
    }
    public function editarServicio($id, $data){
		$this->db->where('id_servicio',$id);
		$this->db->update('servicio',$data);
    }
	public function eliminarServicio($id){
        try {
			$this->db->select('img');
			$this->db->from('servicio');
			$this->db->where("id_servicio = ".$id);
			$res = $this->db->get()->result()[0];
			$file = "./img/servicio/".$res->img;
			unlink($file);
		}catch(Exception $e){}
		$data = 'success';
		$this->db->where('id_servicio',$id);
		$this->db->delete('servicio');
		if($data = $this->db->_error_message());
		return $data;
	}

	//Producto
	public function listarProducto(){
		$this->db->select('*');
		$this->db->from('producto');
		$this->db->order_by('id_producto desc');
		return $this->db->get()->result();
	}
	public function seleccionarProducto($id){
		$this->db->select('*');
		$this->db->from('producto');
		$this->db->where("id_producto = ".$id);
		$this->db->order_by('id_producto asc');
		return $this->db->get()->result();
	}
    public function crearProducto($data){
        $res = $this->db->insert('producto', $data);
		return $this->db->insert_id();
    }
    public function editarProducto($id, $data){
		$this->db->where('id_producto',$id);
		$this->db->update('producto',$data);
    }
	public function eliminarProducto($id){
        try {
			$this->db->select('img');
			$this->db->from('producto');
			$this->db->where("id_producto = ".$id);
			$res = $this->db->get()->result()[0];
			$file = "./img/producto/".$res->img;
			unlink($file);
		}catch(Exception $e){}
		$data = 'success';
		$this->db->where('id_producto',$id);
		$this->db->delete('producto');
		if($data = $this->db->_error_message());
		return $data;
	}

	//Cliente
	public function listarCliente(){
		$this->db->select('*');
		$this->db->from('cliente');
		$this->db->order_by('id_cliente desc');
		return $this->db->get()->result();
	}
	public function seleccionarCliente($id){
		$this->db->select('*');
		$this->db->from('cliente');
		$this->db->where("id_cliente = ".$id);
		$this->db->order_by('id_cliente asc');
		return $this->db->get()->result();
	}
    public function crearCliente($data){
        $res = $this->db->insert('cliente', $data);
		return $this->db->insert_id();
    }
    public function editarCliente($id, $data){
		$this->db->where('id_cliente',$id);
		$this->db->update('cliente',$data);
    }
	public function eliminarCliente($id){
		$data = 'success';
		$this->db->where('id_cliente',$id);
		$this->db->delete('cliente');
		if($data = $this->db->_error_message());
		return $data;
	}

	//Asociado
	public function listarAsociado(){
		$this->db->select('*');
		$this->db->from('asociado');
		$this->db->order_by('id_asociado desc');
		return $this->db->get()->result();
	}
	public function seleccionarAsociado($id){
		$this->db->select('*');
		$this->db->from('asociado');
		$this->db->where("id_asociado = ".$id);
		$this->db->order_by('id_asociado asc');
		return $this->db->get()->result();
	}
    public function crearAsociado($data){
        $res = $this->db->insert('asociado', $data);
		return $this->db->insert_id();
    }
    public function editarAsociado($id, $data){
		$this->db->where('id_asociado',$id);
		$this->db->update('asociado',$data);
    }
	public function eliminarAsociado($id){
		$data = 'success';
		$this->db->where('id_asociado',$id);
		$this->db->delete('asociado');
		if($data = $this->db->_error_message());
		return $data;
	}

	//Cuenta Interna Cliente
	public function listarCuentaInternaCliente(){
		$this->db->select('id_cuenta_interna_cliente, cliente.id_cliente, monto, fecha_ingreso, cliente.nombre AS nombreCliente, cliente.ap_pat AS apPatCliente, cliente.ap_mat AS apMatCliente');
		$this->db->from('cuenta_interna_cliente');
       $this->db->join('cliente', 'cliente.id_cliente = cuenta_interna_cliente.id_cliente');
		$this->db->order_by('id_cuenta_interna_cliente desc');
		return $this->db->get()->result();
	}
	public function seleccionarCuentaInternaCliente($id){
		$this->db->select('id_cuenta_interna_cliente, cliente.id_cliente, monto, fecha_ingreso, cliente.nombre AS nombreCliente, cliente.ap_pat AS apPatCliente, cliente.ap_mat AS apMatCliente');
		$this->db->from('cuenta_interna_cliente');
		$this->db->where("id_cuenta_interna_cliente = ".$id);
       $this->db->join('cliente', 'cliente.id_cliente = cuenta_interna_cliente.id_cliente');
		$this->db->order_by('id_cuenta_interna_cliente asc');
		return $this->db->get()->result();
	}
    public function seleccionarRelCuentaInternaClienteProductos($id){
		$this->db->select('*');
		$this->db->from('cuenta_interna_cliente_producto');
		$this->db->where("id_cuenta_interna_cliente = ".$id);
		$this->db->order_by('id_cuenta_interna_cliente_producto asc');
		return $this->db->get()->result();
    }
    public function seleccionarRelCuentaInternaClienteServicios($id){
		$this->db->select('*');
		$this->db->from('cuenta_interna_cliente_servicio');
		$this->db->where("id_cuenta_interna_cliente = ".$id);
		$this->db->order_by('id_cuenta_interna_cliente_servicio asc');
		return $this->db->get()->result();
    }
    public function crearCuentaInternaCliente($data){
        $res = $this->db->insert('cuenta_interna_cliente', $data);
		return $this->db->insert_id();
    }
    public function crearRelCuentaInternaClienteProductos($data){
        $res = $this->db->insert('cuenta_interna_cliente_producto', $data);
		return $this->db->insert_id();
    }
    public function crearRelCuentaInternaClienteServicios($data){
        $res = $this->db->insert('cuenta_interna_cliente_servicio', $data);
		return $this->db->insert_id();
    }
    public function editarCuentaInternaCliente($id, $data){
		$this->db->where('id_cuenta_interna_cliente',$id);
		$this->db->update('cuenta_interna_cliente',$data);
    }
	public function eliminarCuentaInternaCliente($id){
		$data = 'success';
		$this->db->where('id_cuenta_interna_cliente',$id);
		$this->db->delete('cuenta_interna_cliente');
		if($data = $this->db->_error_message());
		return $data;
	}
	public function eliminarRelCuentaInternaClienteProductos($id){
		$data = 'success';
		$this->db->where('id_cuenta_interna_cliente',$id);
		$this->db->delete('cuenta_interna_cliente_producto');
		if($data = $this->db->_error_message());
		return $data;
	}
	public function eliminarRelCuentaInternaClienteServicios($id){
		$data = 'success';
		$this->db->where('id_cuenta_interna_cliente',$id);
		$this->db->delete('cuenta_interna_cliente_servicio');
		if($data = $this->db->_error_message());
		return $data;
	}




	//Punto
	public function listarPunto(){
		$this->db->select('id_punto, punto.id_cliente, descripcion, cantidad, estado, fecha_registro, fecha_asignacion, cliente.nombre AS nombreCliente, cliente.ap_pat AS apPatCliente, cliente.ap_mat AS apMatCliente');
		$this->db->from('punto');
        $this->db->join('cliente', 'cliente.id_cliente = punto.id_cliente');
		$this->db->order_by('id_punto desc');
		return $this->db->get()->result();
	}
	public function seleccionarPunto($id){
		$this->db->select('id_punto, punto.id_cliente, descripcion, cantidad, estado, fecha_registro, fecha_asignacion, cliente.nombre AS nombreCliente, cliente.ap_pat AS apPatCliente, cliente.ap_mat AS apMatCliente');
		$this->db->from('punto');
		$this->db->where("id_punto = ".$id);
        $this->db->join('cliente', 'cliente.id_cliente = punto.id_cliente');
		$this->db->order_by('id_punto asc');
		return $this->db->get()->result();
	}
    public function crearPunto($data){
        $res = $this->db->insert('punto', $data);
		return $this->db->insert_id();
    }
    public function editarPunto($id, $data){
		$this->db->where('id_punto',$id);
		$this->db->update('punto',$data);
    }
	public function eliminarPunto($id){
		$data = 'success';
		$this->db->where('id_punto',$id);
		$this->db->delete('punto');
		if($data = $this->db->_error_message());
		return $data;
	}

	//Notificacion
	public function listarNotificacion(){
		$this->db->select('*');
		$this->db->from('notificacion');
		$this->db->order_by('id_notificacion desc');
		return $this->db->get()->result();
	}
	public function seleccionarNotificacion($id){
		$this->db->select('*');
		$this->db->from('notificacion');
		$this->db->where("id_notificacion = ".$id);
		$this->db->order_by('id_notificacion asc');
		return $this->db->get()->result();
	}
    public function crearNotificacion($data){
        $res = $this->db->insert('notificacion', $data);
		return $this->db->insert_id();
    }
    public function editarNotificacion($id, $data){
		$this->db->where('id_notificacion',$id);
		$this->db->update('notificacion',$data);
    }
	public function eliminarNotificacion($id){
		$data = 'success';
		$this->db->where('id_notificacion',$id);
		$this->db->delete('notificacion');
		if($data = $this->db->_error_message());
		return $data;
	}

	//Promcoion
	public function listarPromocion(){
		$this->db->select('*');
		$this->db->from('promocion');
		$this->db->order_by('id_promocion desc');
		return $this->db->get()->result();
	}
	public function seleccionarPromocion($id){
		$this->db->select('*');
		$this->db->from('promocion');
		$this->db->where("id_promocion = ".$id);
		$this->db->order_by('id_promocion asc');
		return $this->db->get()->result();
	}
    public function crearPromocion($data){
        $res = $this->db->insert('promocion', $data);
		return $this->db->insert_id();
    }
    public function crearRelPromocionProductos($data){
        $res = $this->db->insert('promocion_producto', $data);
		return $this->db->insert_id();
    }
    public function crearRelPromocionServicios($data){
        $res = $this->db->insert('promocion_servicio', $data);
		return $this->db->insert_id();
    }
    public function seleccionarRelPromocionProductos($id){
		$this->db->select('*');
		$this->db->from('promocion_producto');
		$this->db->where("id_promocion = ".$id);
		$this->db->order_by('id_promocion_producto asc');
		return $this->db->get()->result();
    }
    public function seleccionarRelPromocionServicios($id){
		$this->db->select('*');
		$this->db->from('promocion_servicio');
		$this->db->where("id_promocion = ".$id);
		$this->db->order_by('id_promocion_servicio asc');
		return $this->db->get()->result();
    }
    public function editarPromocion($id, $data){
		$this->db->where('id_promocion',$id);
		$this->db->update('promocion',$data);
    }
	public function eliminarPromocion($id){
		$data = 'success';
		$this->db->where('id_promocion',$id);
		$this->db->delete('promocion');
		if($data = $this->db->_error_message());
		return $data;
	}
	public function eliminarRelPromocionProductos($id){
		$data = 'success';
		$this->db->where('id_promocion',$id);
		$this->db->delete('promocion_producto');
		if($data = $this->db->_error_message());
		return $data;
	}
	public function eliminarRelPromocionServicios($id){
		$data = 'success';
		$this->db->where('id_promocion',$id);
		$this->db->delete('promocion_servicio');
		if($data = $this->db->_error_message());
		return $data;
	}

	//RESERVA
	public function listarReserva(){
		$this->db->select('reserva.id_reserva, reserva.id_cliente, reserva.id_puesto, fecha, hora, estado, cliente.nombre AS nombreCliente, cliente.ap_pat AS apPatCliente, cliente.ap_mat AS apMatCliente, puesto.nombre AS nombrePuesto');
		$this->db->from('reserva');
        $this->db->join('cliente', 'cliente.id_cliente = reserva.id_cliente');
        $this->db->join('puesto', 'puesto.id_puesto = reserva.id_puesto');
		$this->db->order_by('id_reserva desc');
		return $this->db->get()->result();
	}
	public function seleccionarReserva($id){
		$this->db->select('reserva.id_reserva, reserva.id_cliente, reserva.id_puesto, fecha, hora, estado, cliente.nombre AS nombreCliente, cliente.ap_pat AS apPatCliente, cliente.ap_mat AS apMatCliente, puesto.nombre AS nombrePuesto');
		$this->db->from('reserva');
		$this->db->where("id_reserva = ".$id);
        $this->db->join('cliente', 'cliente.id_cliente = reserva.id_cliente');
        $this->db->join('puesto', 'puesto.id_puesto = reserva.id_puesto');
		$this->db->order_by('id_reserva desc');
		return $this->db->get()->result();
	}
    public function seleccionarRelReservaServicios($id){
		$this->db->select('*');
		$this->db->from('reserva_servicio');
		$this->db->where("id_reserva = ".$id);
		$this->db->order_by('id_reserva_servicio asc');
		return $this->db->get()->result();
    }
    public function crearReserva($data){
        $res = $this->db->insert('reserva', $data);
		return $this->db->insert_id();
    }
    public function crearRelReservaServicios($data){
        $res = $this->db->insert('reserva_servicio', $data);
		return $this->db->insert_id();
    }
    public function editarReserva($id, $data){
		$this->db->where('id_reserva',$id);
		$this->db->update('reserva',$data);
    }
	public function eliminarReserva($id){
		$data = 'success';
		$this->db->where('id_reserva',$id);
		$this->db->delete('reserva');
		if($data = $this->db->_error_message());
		return $data;
	}
	public function eliminarReservaServicios($id){
		$data = 'success';
		$this->db->where('id_reserva',$id);
		$this->db->delete('reserva_servicio');
		if($data = $this->db->_error_message());
		return $data;
	}

	// Configuracion Cliente
	public function listarConfiguracionCliente(){
		$this->db->select('*');
		$this->db->from('configuracion_cliente');
		$this->db->order_by('id_configuracion_cliente desc');
		return $this->db->get()->result();
	}
	public function seleccionarConfiguracionCliente($id){
		$this->db->select('*');
		$this->db->from('configuracion_cliente');
		$this->db->where("id_configuracion_cliente = ".$id);
		$this->db->order_by('id_configuracion_cliente asc');
		return $this->db->get()->result();
	}
    public function editarConfiguracionCliente($id, $data){
		$this->db->where('id_configuracion_cliente',$id);
		$this->db->update('configuracion_cliente',$data);
    }

	// VIDEO
    public function existeVideo($video_name=""){
        $this->db->where('ruta',$video_name);
        $consulta = $this->db->get('video');
		if($consulta->num_rows() >= 1){
			$row = $consulta->row();
			return $row->ruta;
		}
    }
	public function listarVideo(){
		$this->db->order_by('id_video desc');
		return $this->db->get('video')->result();
	}
    public function insertarVideo($data){
        $res = $this->db->insert('video', $data);
        return $res;
    }
	public function eliminarVideo($id){
        $this->db->select('*');
        $this->db->from('video');
        $this->db->where("id_video = ".$id);
        $res = $this->db->get()->result()[0];
        $file = "video/".$res->ruta;
        try {
			unlink($file);
		}catch(Exception $e){
		}
        $this->db->where('id_video',$id);
        $this->db->delete('video');
        // if (is_readable($file) && unlink($file)) {
        // }
	}
}
