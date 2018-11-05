<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pantalla extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url', 'html'));
        $this->load->model('pantalla_model');
	}
	
	public function index(){
		$data['videos'] = $this->pantalla_model->listarVideo();
//		$data = '';
		$this->load->view('pantalla_view', $data);
	}

}
?>
