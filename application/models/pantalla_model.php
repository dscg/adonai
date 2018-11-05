<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Pantalla_model extends CI_Model {
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
}
