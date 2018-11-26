<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Admin_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	//PERSONAL
	public function listarPersonal(){
		$this->db->select('*');
		$this->db->from('personal');
		$this->db->order_by('id_personal desc');
		return $this->db->get()->result();
	}
	public function seleccionarPersonal($id){
		$this->db->select('*');
		$this->db->from('personal');
		$this->db->where("id_personal = ".$id);
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

	//PRODUCTO
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

	//RESERVA
	public function listarReserva(){
		$this->db->select('*');
		$this->db->from('reserva_config');
		$this->db->order_by('id_reserva_config desc');
		return $this->db->get()->result();
	}
	public function seleccionarReserva($id){
		$this->db->select('*');
		$this->db->from('reserva_config');
		$this->db->where("id_reserva_config = ".$id);
		$this->db->order_by('id_reserva_config asc');
		return $this->db->get()->result();
	}
    public function editarReserva($id, $data){
		$this->db->where('id_reserva_config',$id);
		$this->db->update('reserva_config',$data);
    }

	//CLIENTE
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
	public function eliminarPromocionServicios($id){
		$data = 'success';
		$this->db->where('id_promocion',$id);
		$this->db->delete('promocion_servicio');
		if($data = $this->db->_error_message());
		return $data;
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
