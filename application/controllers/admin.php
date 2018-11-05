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
		$this->load->view('admin_view');
	}

    function validarSession() {
		if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'admin'){
			redirect(base_url().'login');
		} else {
			return true;
		}
    }

     // VIDEO
    public function listaVideo(){
        $data['videos'] = $this->admin_model->listarVideo();
        $this->load->view('admin_video_view', $data);
//        $this->load->view('admin_video_view');
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
    public function insertarVideo(){
        $this->load->view('insertar_video_view');
    }
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
*/

/*
    public function insertarPersonal(){
        if ($this->validarSession()) {
            $data['estudiantes'] = $this->amsdmams_model->listarEstudiante();
            $this->load->view('insertar_docente_blog_est_view', $data);
        }
    }
    public function editarPersonal($id){
        if ($this->validarSession()) {
            $data['blog_estudiante'] = $this->usuario_model->seleccionarBlogEstudiante($id)[0];
            $this->load->view('editar_docente_blog_est_view', $data);
        }
    }
*/
    //PERSONAL
    public function listaPersonal(){
        if ($this->validarSession()) {
            $data['personal'] = $this->admin_model->listarPersonal();
            $this->load->view('admin_personal_view', $data);
        }
    }
    public function seleccionarPersonal(){
        if ($this->validarSession()) {
            $id_personal = $this->input->post('id_personal');
            $data = $this->admin_model->seleccionarPersonal($id_personal);
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
    public function crearPersonal(){
        if ($this->validarSession()) {
            $data['nombre'] = $this->input->post('nombre');
            $data['ap_pat'] = $this->input->post('ap_pat');
            $data['ap_mat'] = $this->input->post('ap_mat');
            $data['genero'] = $this->input->post('genero');
            $data['email'] = $this->input->post('email');
            $data['telefono'] = $this->input->post('telefono');
            $data['celular'] = $this->input->post('celular');
            $data['direccion'] = $this->input->post('direccion');
            $data['ci'] = $this->input->post('ci');
            $data['expedido'] = $this->input->post('expedido');
            $data['fecha_nacimiento'] = $this->input->post('fecha_nacimiento');
            $data['fecha_inicio'] = $this->input->post('fecha_inicio');
            //$data['fecha_inicio'] = date('Y-m-d');
            $this->admin_model->crearPersonal($data);
            echo json_encode(true);
        }
    }
    public function actualizarPersonal($id){
        if ($this->validarSession()) {
            $data['id_personal'] = $id;
            $data['nombre'] = $this->input->post('nombre');
            $data['ap_pat'] = $this->input->post('ap_pat');
            $data['ap_mat'] = $this->input->post('ap_mat');
            $data['genero'] = $this->input->post('genero');
            $data['email'] = $this->input->post('email');
            $data['telefono'] = $this->input->post('telefono');
            $data['celular'] = $this->input->post('celular');
            $data['direccion'] = $this->input->post('direccion');
            $data['ci'] = $this->input->post('ci');
            $data['expedido'] = $this->input->post('expedido');
            $data['fecha_nacimiento'] = $this->input->post('fecha_nacimiento');
            $data['fecha_inicio'] = $this->input->post('fecha_inicio');
            $this->admin_model->editarPersonal($id, $data);
            echo json_encode(true);
        }
    }
    public function eliminarPersonal($id){
        if ($id == NULL OR !is_numeric($id)){
            echo json_encode('error');
            return;
        }
        $this->admin_model->eliminarPersonal($id);
		echo json_encode('success');
		return;
    }
}
?>
