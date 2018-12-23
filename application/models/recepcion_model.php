<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recepcion_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	//SERVICIO
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
}
