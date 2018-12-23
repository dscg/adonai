<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Caja_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function login_user($username,$password)
	{
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('users');
		if($query->num_rows() == 1)
		{
			return $query->row();
		}else{
			$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
			redirect(base_url().'login','refresh');
		}
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

}
