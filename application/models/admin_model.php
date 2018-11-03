<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Admin_model extends CI_Model {
	public function __construct() {
		parent::__construct();
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
		if($data['error'] = $this->db->_error_message());
		return $data;
	}

}
