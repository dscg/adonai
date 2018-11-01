<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function login_user($username, $password){
		$this->db->where('user',$username);
		$this->db->where('pass',$password);
		$query = $this->db->get('usuario');
		if($query->num_rows() == 1){
			return $query->row();
		}else{
			$this->session->set_flashdata('usuario_incorrecto','<div style="background-color:white; border-radius:5px; border:2px solid red;color:red; font-family:arial; font-size:14px;">Los datos introducidos son incorrectos</div>');
			redirect(base_url().'login','refresh');
		}
	}
}
?>
