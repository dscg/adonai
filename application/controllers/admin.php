<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url', 'html', 'form'));
        $this->load->model('admin_model');
	}
	
	public function index(){
		if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'admin'){
			redirect(base_url().'login');
		}
		$data['titulo'] = 'Bienvenido Administrador';
		$this->load->view('admin_view',$data);
	}

     // VIDEO
    public function listaVideo(){
        $data['videos'] = $this->admin_model->listarVideo();
        $this->load->view('admin_video_view', $data);
//        $this->load->view('admin_video_view');
    }
    public function insertarVideo(){
        $this->load->view('insertar_video_view');
    }

    public function eliminarVideo($id){
        if ($id == NULL OR !is_numeric($id)){
            echo json_encode('error');
            return;
        }
        $this->admin_model->eliminarVideo($id);
		echo json_encode('success');
		return;
    }

	public function subirVideo(){
		if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
			unset($config);
			$date = date("ymd");
			$configVideo['max_size'] = '0';// 0 no limit in bytes this field
			$configVideo['overwrite'] = FALSE;
			$configVideo['remove_spaces'] = TRUE;
			$video_name = $date.$_FILES['file']['name'];
			$configVideo['file_name'] = $video_name;
			$configVideo['upload_path'] = './video';
			$configVideo['allowed_types'] = 'gif|jpg|png|mp4|webm|avi|flv';
			$ruta_video_duplicado = $this->admin_model->existeVideo($video_name);
			if ($ruta_video_duplicado == $video_name) {
				echo "existe_video";
				exit();
			}
			$this->load->library('upload', $configVideo);
			$this->upload->initialize($configVideo);
			if (!$this->upload->do_upload('file')) { #Aquí me refiero a "foto", el nombre que pusimos en FormData
				$error = array('error' => $this->upload->display_errors());
				echo json_encode($error);
			} else {
				$file_info = $this->upload->data();
				$data['ruta'] = $file_info['file_name'];
				$data['titulo'] = $this->input->post('title');
				$this->admin_model->insertarVideo($data);
				echo json_encode(true);
			}
	//		redirect(base_url().'admin');
		}else{
			echo "Por favor seleccione un archivo";
		}

	}

/*
 
    if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {
        unset($config);
        $date = date("ymd");
        $configVideo['upload_path'] = './video';
        $configVideo['max_size'] = '60000';
        $configVideo['allowed_types'] = 'avi|flv|wmv|mp3|mp4';
        $configVideo['overwrite'] = FALSE;
        $configVideo['remove_spaces'] = TRUE;
        $video_name = $date.$_FILES['video']['name'];
        $configVideo['file_name'] = $video_name;
        $this->load->library('upload', $configVideo);
        $this->upload->initialize($configVideo);
        if(!$this->upload->do_upload('video')) {
            echo $this->upload->display_errors();
        }else{
            $videoDetails = $this->upload->data();
            $data['video_name']= $configVideo['file_name'];
            $data['video_detail'] = $videoDetails;
            $this->load->view('movie/show', $data);
        }
        
    }else{
        echo "Please select a file";
    }

*/
    public function crearVideo(){
        $dataArchivo['titulo'] = $this->input->post('nombre');
        $dataArchivo['ruta'] = $this->input->post('fecha');
        $this->pantalla_model->crearAdministrador($dataAdmin);
        redirect(base_url().'index.php/pantalla/listaArchivo?save=true');
    }
    public function editarConfiguracion($id){
        $data['configuracion'] = $this->pantalla_model->seleccionarConfiguracion($id)[0];
        $this->load->view('editar_configuracion_view', $data);
    }
    public function actualizarConfiguracion($id){
        $data['tiempo_imagenes'] = $this->input->post('tiempo_imagenes');
        $data['tiempo_panel'] = $this->input->post('tiempo_panel');
        $data['tiempo_sub_panel'] = $this->input->post('tiempo_sub_panel');
        $this->pantalla_model->editarConfiguracion($id, $data);
        redirect(base_url().'index.php/pantalla/listaConfiguracion?update=true');
    }

}
?>
