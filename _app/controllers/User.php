<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('user_model');
	}
	
	public function index() {
		redirect('/agenda/consultaHC');
	}
	
	public function testSession(){
		print_r($this->session);
	}

	public function login() {		
		if ($this->session->userdata('login') != null) { redirect('/agenda/consultaHC');}
		
		$data = new stdClass();
		$data->page = "login";
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Usuario', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Contraseña', 'required');
		
		if ($this->form_validation->run() == false) {
			$this->load->view('inc/header', $data);
			$this->load->view('user/login', $data);
			$this->load->view('inc/footer', $data);
		}else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$res = $this->user_model->userLogin($username, $password);

			switch($res["estado"]){
				Case "2": # Login correcto (unico servicio)
					$sessionNueva = array(
						'login' 		=> 1, 
						'username' 		=> $res["datos"][0]["username"],
						'matricula' 	=> $username,					
						'id_servicio' 	=> $res["datos"][0]["id"],
						'servicio' 		=> $res["datos"][0]["sector"],
						'oficina' 		=> "-",
						'consul' 		=> "-",
						'enfermeria' 	=> "0"
					);
	
					$this->session->set_userdata($sessionNueva);
					$this->user_model->setEstadoEnfermero($this->session->userdata('matricula'), $this->session->userdata('id_servicio'));
					redirect('/agenda/consultaHC');
					break;
				
				Case "3": # Login correcto (multiple servicio)
					$sessionNueva = array(
						'login' 		=> 2, 
						'username' 		=> $res["datos"][0]["username"],
						'matricula' 	=> $username,					
						'id_servicio' 	=> 0,
						'servicio' 		=> "",
						'oficina' 		=> "-",
						'consul' 		=> "-",
						'enfermeria' 	=> "0"
					);
					
					$this->session->set_userdata($sessionNueva);
					$data->servicios = $this->user_model->GetServiciosMatricula($username);

					$this->load->view('inc/header', $data);
					$this->load->view('user/selectServicio', $data);
					$this->load->view('inc/footer', $data);
					break;
				
				Case "1": # Login incorrecto
					$data->error = 'Usuario o Contraseña Incorrectos.';
				
					$this->load->view('inc/header', $data);
					$this->load->view('user/login', $data);
					$this->load->view('inc/footer', $data);
					break;
				
				default:
					$data->error = 'Se produjo un error interno. Intente nuevamente mas tarde.';
				
					$this->load->view('inc/header', $data);
					$this->load->view('user/login', $data);
					$this->load->view('inc/footer', $data);
					break;
					
			} 
		}
	}
	
	public function cambiarServicio(){
		$data = new stdClass();
		$data->page = "login";
		$data->servicios = $this->user_model->GetServiciosMatricula($this->session->userdata('matricula'));
					
		$this->load->view('inc/header', $data);
		$this->load->view('user/selectServicio', $data);
		$this->load->view('inc/footer', $data);
	}
	
	public function selectServicio(){
		if(isset($_POST['cboServicio'])){
			$servicio = $_POST['cboServicio'];
			$aServicio = explode("^",$servicio);
			
			$this->session->set_userdata('id_servicio', $aServicio[0]);
			$this->session->set_userdata('servicio', $aServicio[1]);
			$this->session->set_userdata('login', 1);
			$this->user_model->setEstadoEnfermero($this->session->userdata('matricula'), $this->session->userdata('id_servicio'));
			
			redirect("/");
			
		}else{
			$data = new stdClass();
			$data->page = "login";
			$data->servicios = $this->user_model->GetServiciosMatricula($this->session->userdata('matricula'));
			$data->error = "Error al cambiar el servicio.";
			
			$this->load->view('inc/header', $data);
			$this->load->view('user/selectServicio', $data);
			$this->load->view('inc/footer', $data);
		}
	}
	
	public function getBoxes(){
		$id = $_POST['val'];
		
		$data = $this->user_model->GetBoxes($id);
		
		/*if (isset($data->BOX)){
			$retorno = $data->BOX;
		}else{
			$retorno = "";
		}
		
		echo ($retorno);*/
		echo $data;
	}
	
	public function getAviso(){
		$data = $this->user_model->getAviso(); 		
		
		echo json_encode($data);
	}
	
	public function cambiarConsul(){
		$data = new stdClass();
		$data->page = "login";
		$data->consultorios = $this->user_model->GetConsultorios();
		
		$this->load->view('inc/header', $data);
		$this->load->view('user/SelectConsul', $data);
		$this->load->view('inc/footer', $data);
	}
	
	public function selectConsul(){
		$data = new stdClass();

		if(isset($_POST['cboBox']) && isset($_POST['cboUbicacion'])){
			$consul = $_POST['cboBox'];
			$ofi = $_POST['cboUbicacion'];

			$this->session->set_userdata('consul', $consul);
			$this->session->set_userdata('oficina', $ofi);
		}else{
			$data->error = "Debe seleccionar el consultorio donde se encuentra atendiendo.";
		}
		
		if($data->error == ""){
			redirect("/");
		}else{
			$data->page = "login";
			$data->consultorios = $this->user_model->GetConsultorios();
			
			$this->load->view('inc/header', $data);
			$this->load->view('user/SelectConsul',$data);
			$this->load->view('inc/footer', $data);
		}
	}
	
	public function cambiarPassword() 
	{
		if ($this->session->userdata('login') == null) 
		{
			redirect('user/login');			
		}
		else
		{
			if ($this->session->userdata('activo') == 0) 
			{				
				$data = new stdClass();
				$data->page = "login";
				
				$this->load->helper('form');
				$this->load->library('form_validation');
				
				$this->form_validation->set_rules('oldPassword', 'Contraseña Actual', 'required');
				$this->form_validation->set_rules('newPassword', 'Nueva Contraseña', 'required');
				$this->form_validation->set_rules('new2Password', 'Repetir Contraseña', 'required');
				
				if ($this->form_validation->run() == false) 
				{
					$this->load->view('inc/header', $data);
					$this->load->view('user/cambioPassword', $data);
					$this->load->view('inc/footer', $data);
				}
				else
				{
					$oldPassword = $this->input->post('oldPassword');
					$newPassword = $this->input->post('newPassword');
					$new2password = $this->input->post('new2Password');
					//$correo = $this->input->post('correo');
					
					$data->error = "";
					
					if (!($this->user_model->resolve_user_login($this->session->userdata('matricula'), $oldPassword)))
					{
						$data->error = 'La actual contraseña es incorrecta.';
					}
					
					if ($oldPassword == "" || $newPassword == "" || $new2password == "") 
					{
						$data->error = 'Todos los campos de contraseña son obligatorios.';	
					} 
					
					if (strlen($newPassword) < 8)
					{
						$data->error = 'La contraseña nueva debe tener al menos 8 caracteres.';
					}
					
					if ($newPassword != $new2password) 
					{
						$data->error = 'Las contraseñas no coinciden.';	
					} 

					$res = $this->user_model->cambioPassword($this->session->userdata('matricula'), $newPassword);	
					if ($res != "0")
					{
						$data->error = $res;	
					}
					if ($data->error == "") 
					{
						
						
						$this->logout(false);
						
						$data->error = 'Cambio realizado. Debe iniciar sesion Nuevamente';	

						$this->load->view('inc/header', $data);
						$this->load->view('user/login', $data);
						$this->load->view('inc/footer', $data);
					}
					else 
					{
						$this->load->view('inc/header', $data);
						$this->load->view('user/cambioPassword', $data);
						$this->load->view('inc/footer', $data);
					}
				}
			}
			else
			{
				redirect('/');
			}
		}
	}
	
	public function logout($redirect = true) 
	{
		if ($this->session->userdata('login') != null)
		{
			$this->session->sess_destroy();
		}
		
		if ($redirect)
		{
			redirect("/");
		}
	}
	
	public function restablecerPassword() 
	{		
		if ($this->session->userdata('login') != null) 
		{
			redirect('/');	
		}
		else
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('usuario', 'Usuario', 'required');
			$this->form_validation->set_rules('correo', 'Correo Electronico', 'required');
			
			$data = new stdClass();
			$data->page = "login";
			
			if ($this->form_validation->run() == false) 
			{
				$this->load->view('inc/header', $data);
				$this->load->view('user/restablecerPassword', $data);
				$this->load->view('inc/footer', $data);
			}
			else
			{

				$usuario = $this->input->post('usuario');
				$correo = $this->input->post('correo');
				
				$data->error = "";
					
				if (!($this->user_model->comprobar_correo($usuario, $correo)))
				{
					$data->error = 'El correo ingresado no corresponde con el asociado al usuario.';
				}
				
				if ($data->error == "") 
				{
					
					$pass = $this->user_model->renovarPassword($usuario);
					$user = $this->user_model->get_user($usuario);
					
					$this->enviarPassword($user->email, $pass, $user->nombre);
					
					$this->load->view('inc/header', $data);
					$this->load->view('user/passwordEnviado', $data);
					$this->load->view('inc/footer', $data);
				}
				else 
				{
					$this->load->view('inc/header', $data);
					$this->load->view('user/restablecerPassword', $data);
					$this->load->view('inc/footer', $data);
				}
				
			}
			
		}
		
	}
	
	private function enviarPassword($destino, $pass, $nombre){

		$this->load->library('email');
		
		$data = array('password' => $pass,'nombre' => $nombre);
		
		$mensaje = $this->load->view('user/mailPassword',$data,true);
		
		$this->email->clear();
		
		$this->email->to($destino);
		$this->email->bcc('sistemas@laslomas.com.ar');
		$this->email->from('info@laslomas.com.ar');
		$this->email->subject('Contraseña Restablecida');
		$this->email->message($mensaje);
		$this->email->send();
		
		
		echo '<!--' . print_r($this->email->print_debugger(), true) . '-->'; 
	}
	
	public function actualizarDatos() 
	{
		if ($this->session->userdata('login') == null) 
		{
			redirect('user/login');			
		}
		else
		{
			
			$data = new stdClass();
			$data->page = "login";
			
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('oldPassword', 'Contraseña Actual', 'required');
			$this->form_validation->set_rules('correo', 'Correo Electronico', 'required');
			$this->form_validation->set_rules('sector', 'Sector', 'required');
			
			if ($this->form_validation->run() == false) 
			{
				$this->load->view('inc/header', $data);
				$this->load->view('user/actualizarDatos', $data);
				$this->load->view('inc/footer', $data);
			}
			else
			{
				$passNueva = False;
				
				$oldPassword = $this->input->post('oldPassword');
				$newPassword = $this->input->post('newPassword');
				$new2password = $this->input->post('new2Password');
				$correo = $this->input->post('correo');
				$sector = $this->input->post('sector');
				
				$data["error"] = "";
				$data["menu"] = "0";
				
				if (!($this->user_model->resolve_user_login($this->session->userdata('user'), $oldPassword)))
				{
					$data->error = 'La actual contraseña es incorrecta.';
				}
				
				if ($newPassword != "")
				{
					
					if (strlen($newPassword) < 8)
					{
						$data->error = 'La contraseña nueva debe tener al menos 8 caracteres.';
					}
					
					if ($newPassword != $new2password) 
					{
						$data->error = 'Las contraseñas no coinciden.';	
					} 
					
				}
				else
				{
					$newPassword = $oldPassword;
				}

				
				if ($data->error == "") 
				{
					$this->user_model->cambioPassword($this->session->userdata('user_id'), $newPassword, $correo, $sector);
					
					$this->logout(false);
					
					$this->load->view('inc/header', $data);
					$this->load->view('user/password_correcto', $data);
					$this->load->view('inc/footer', $data);
					
				}
				else 
				{
					$this->load->view('inc/header', $data);
					$this->load->view('user/actualizarDatos', $data);
					$this->load->view('inc/footer', $data);
				}
			}
		}
	}
	
	public function actualizarPerfil(){
		$data = new stdClass();
		$data->page = "perfil";
		$data->txt = $this->user_model->getPerfilProfesional();
		$data->img = $this->getProfileImage();
		
		$this->load->view('inc/header', $data);
		$this->load->view('user/perfil/viewActualizacionPerfil', $data);
		$this->load->view('inc/footer', $data);
	}

	public function getImageProfile($imgName){
		$remoteImage = RUTA_PERFILES . $imgName;
		$imginfo = getimagesize($remoteImage);
		header("Content-type: {$imginfo['mime']}");
		readfile($remoteImage);
	}

	private function getProfileImage(){
		$path = RUTA_PERFILES . $this->session->userdata("matricula");
		
		$img = "";
		if(file_exists($path.".jpg")){
			$img = "getImageProfile/" . $this->session->userdata("matricula") . ".jpg";
		}
		
		if(file_exists($path.".png")){
			$img = "getImageProfile/" . $this->session->userdata("matricula") . ".png";
		}
		
		if($img == ""){
			$img = "getImageProfile/perfil.jpg";
		}
		
		return $img;
	}
	
	public function uploadImage(){
		$data = new stdClass();
		$data->page = "perfil";
		$data->img = $this->getProfileImage();
		$data->txt = $res = $this->user_model->getPerfilProfesional();

		try {
		
			//Tipos Adminitos
			$tipos = Array("image/jpeg", "image/png", "image/jpg");

			if (!in_array($_FILES['fileToUpload']['type'], $tipos)) {
				throw new Exception('Tipo de archivo invalido.');
			}

			// Archivo
			$file = explode(".", basename($_FILES['fileToUpload']['name']));
			$url = RUTA_PERFILES . $this->session->userdata("matricula") . "." . end($file);


			// Mueve el archivo
			if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $url)) {
				$data->ok = "Imagen actualizada correctamente.";
				$data->img = "getImageProfile/".$this->session->userdata("matricula") . "." . end($file);
			} else {
			    echo "No se pudo subir el archivo solicitado, intente nuevamente mas tarde.";
			}
		} catch (Exception $e) {
			$data->error = "Error: " . $e->getMessage();
		}
		
		$this->load->view('inc/header', $data);
		$this->load->view('user/perfil/viewActualizacionPerfil', $data);
		$this->load->view('inc/footer', $data);
	}
	
	public function setPerfilProfesional() 
	{
		$data = new stdClass();
		$data->page = "perfil";
		$data->img = $this->getProfileImage();
		$data->txt = "";
		$res = "";
		
		try {
			if (!isset($_POST['txtPerfil'])){
				throw new Exception('No se recibieron los datos necesarios.');
			}
			
			if ($_POST['txtPerfil'] == ""){
				throw new Exception('Debe completar el Perfil Profesional para poder guardar datos.');
			}
			
			$res = $this->user_model->setPerfilProfesional($_POST['txtPerfil']);
			
		} catch (Exception $e) {
			$data->error = "Error: " . $e->getMessage();
		}
		
		if($res == "0"){
			$data->ok = "Perfil actualizado correctamente.";
			$data->txt = $res = $this->user_model->getPerfilProfesional();
		}
		
		$this->load->view('inc/header', $data);
		$this->load->view('user/perfil/viewActualizacionPerfil', $data);
		$this->load->view('inc/footer', $data);
	}

	//---------------------------INFRAMUNDO------------------------------------
	
	/*public function cambiarConsul(){
		$data = new stdClass();
		$data->page = "login";
		
		$this->load->view('inc/header', $data);
		$this->load->view('user/SelectConsul', $data);
		$this->load->view('inc/footer', $data);
	}
	
	public function selectConsul(){
		$data = new stdClass();
		if(isset($_POST['nroConsul'])){
			$consul = $_POST['nroConsul'];
			
			if (is_numeric($consul)){
				
				if($consul > 0 && $consul < 21){
					$this->session->set_userdata('consul', $consul);
				}else{          
					$data->error = "Controle que el numero de consultorio sea el correcto.";
				}
				
			}else{
				$data->error = "Debe ingresar solamente el numero de consultorio.";
			}
		}else{
			$data->error = "Debe ingresar un numero de consultorio.";			
		}
		
		if($data->error == ""){
			redirect("/");
		}else{
			$data->page = "login";

			$this->load->view('inc/header', $data);
			$this->load->view('user/SelectConsul',$data);
			$this->load->view('inc/footer', $data);
		}
	}*/
	
}
