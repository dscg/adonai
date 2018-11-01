<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		$this->load->model('login_model');
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('url','form'));
		$this->load->database('default');
    }
	public function index(){	
		switch ($this->session->userdata('perfil')) {
			case '':
				$data['token'] = $this->token();
				$data['titulo'] = 'Login Adonai';
				$this->load->view('login_view',$data);
				break;
			case 'sistem':
				redirect(base_url().'sistem');
				break;
			case 'admin':
				redirect(base_url().'admin');
				break;
			case 'caja':
				redirect(base_url().'caja');
				break;	
			default:
                $data['token'] = $this->token();
				$data['titulo'] = 'Login Adonai';#0A0A0A
				$this->load->view('login_view',$data);
				break;		
		}
	}
	public function token(){
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}

	public function new_user(){
		if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')){
            $this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
            $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[3]|max_length[150]|xss_clean');
			
            //lanzamos mensajes de error si es que los hay
			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('dato_no_valido','<div style="background-color:white; border-radius:5px; border:2px solid red;color:red; font-family:arial; font-size:14px;">Los datos no son validos</div>');
				redirect(base_url().'login','refresh');
//				redirect(base_url().'login');
//				echo 'error validacion';
			}else{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$password = md5($this->input->post('password'));
				$check_user = $this->login_model->login_user($username,$password);
				if($check_user == TRUE){
					$id_admin_session = 0;
					if ($check_user->tipo == 'admin') {
						$id_admin_session = 1;
						//$id_administrador_session = $this->usuario_model->getAdministradorUsuario($check_user->id_usuario)[0];
					}
					$id_caja_session = 0;
					if ($check_user->tipo == 'caja') {
						$id_caja_session = 1;
						//$id_docente_session = $this->usuario_model->getDocenteUsuario($check_user->id_usuario)[0];
					}
					$data = array(
	                'id_usuario' => $check_user->id_usuario,
	                'perfil' => $check_user->tipo,
	                'username' => $check_user->user,
            		'id_admin' => ($id_admin_session == TRUE) ? $id_admin_session : 0,
            		'id_caja' => ($id_caja_session == TRUE) ? $id_caja_session : 0
            		);
            		$this->session->set_userdata($data);
					$this->index($check_user->id_usuario);
				}
			}
		}else{
			redirect(base_url().'login');
		}
	}
	
}
?>
