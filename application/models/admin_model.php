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

	//PLAN
	public function listarPlan(){
		$this->db->select('*');
		$this->db->from('plan');
		$this->db->order_by('id_plan desc');
		return $this->db->get()->result();
	}
	public function seleccionarPlan($id){
		$this->db->select('*');
		$this->db->from('plan');
		$this->db->where("id_plan = ".$id);
		$this->db->order_by('id_plan asc');
		return $this->db->get()->result();
	}
    public function crearPlan($data){
        $res = $this->db->insert('plan', $data);
		return $this->db->insert_id();
    }
    public function editarPlan($id, $data){
		$this->db->where('id_plan',$id);
		$this->db->update('plan',$data);
    }
	public function eliminarPlan($id){
		$data = 'success';
		$this->db->where('id_plan',$id);
		$this->db->delete('plan');
		if($data['error'] = $this->db->_error_message());
		return $data;
	}

}
