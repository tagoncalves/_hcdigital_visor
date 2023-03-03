<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
- 10/04/2018: ACTUALIZO FUNCIONES A WS UNIVERSAL. (CUNDA)
*/

class User_model extends CI_Model {
	public function __construct() {
		parent::__construct();

		$config = array(
			'mserver' => MSERVER,
			'namespace' => MNAMESPACE, 
			'http_server' => IP_WS,
			'port' => RandPortWS()
		);
		
		$this->load->library('VisM',$config);
	}

	public function getAviso(){
		$this->vism->borrar_cache();
		
		$this->vism->execute("D GETAVISO^HCDIGITAL(.P9)");

		$ret["aviso"] = utf8_encode($this->vism->P9);
		
		return $ret; 
	}
	
	public function userLogin($username, $password) {
		$this->vism->borrar_cache();
		$this->vism->P0 = $username;
		$this->vism->P1 = $password;

		# USU, PASS, RET, SER, CAN
		# RET=2 OK, RET=1 ERROR
		$this->vism->execute("D LOGIN^VBTURSLL(P0,P1,.P7,.P8,.P9)");

		$res["estado"] = $this->vism->P7;
		$cantidad = intval($this->vism->P9);
		$arr = array();

		if($res["estado"] == "2" || $res["estado"] == "3"){
			$servicios = explode("|", $this->vism->P8);
			
			for($i=0; $i<$cantidad; $i++){
				$registro = explode("^", $servicios[$i]);

				$datos["id"] = $registro[0];
				$datos["sector"] = $registro[1];
				$datos["username"] = $registro[2];

				array_push($arr, $datos);
			}
		}

		$res["datos"] = $arr;
		return $res;

	}
	
	public function GetServiciosMatricula($matricula) {
		$this->vism->borrar_cache();
		$this->vism->P0 = $matricula;

		# USU, SERVICIOS
		$this->vism->execute("D SERVXMAT^VBTURSLLX(P0,.P9)");

		$arr = array();
		$servicios = explode("|", $this->vism->P9);
		
		foreach($servicios as $serv){
			$data = explode("^", $serv);

			$datos["id"] = $data[0];
			$datos["sector"] = $data[1];

			array_push($arr, $datos);
		}

		return $arr;
	}
	
	public function GetConsultorios() {
		$this->vism->borrar_cache();
		# DATOS, CANT
		$this->vism->execute("D GETOFICINAS^HCDIGITAL(.P8,.P9)");

		$arr = array();
		$consultorios = explode("|", $this->vism->P8);
		
		foreach($consultorios as $consul){
			$data = explode("^", $consul);

			$datos["id"] = $data[0];
			$datos["oficina"] = $data[1];

			array_push($arr, $datos);
		}

		return $arr;
	}
	
	public function GetBoxes($id) {
		$this->vism->borrar_cache();
		$this->vism->P0 = $id;
		
		# ID, DATOS, CANT
		$this->vism->execute("D GETBOXES^HCDIGITAL(P0,.P8,.P9)");

		$boxes = explode("|", $this->vism->P8);
		$temp = "";
		foreach($boxes as $box){
			$data = explode("^", $box);
			$temp .= '<option value="'.$data[1].'">'.$data[1].'</option>';
		}

		return $temp;
	}

	public function cambioPassword($user, $password) {
		$this->vism->borrar_cache();
		$this->vism->P0 = $user;
		$this->vism->P1 = $password;
		
		// SEC, DATOS, CANTIDAD
		$this->vism->execute("D CAMBIOPASS^HCDIGITAL(P0,P1,.P9)");

		return $this->vism->P9;	
	}
	
	public function setPerfilProfesional($text)
	{
		$this->vism->borrar_cache();
		$this->vism->P0 = $this->session->userdata('matricula');
		$this->vism->P1 = $text;
		$this->vism->execute("D SETPERFIL^VBLOGIN(P0,P1,.P9)");
		
		return $this->vism->P9;	
	}
	
	public function getPerfilProfesional()
	{
		$this->vism->borrar_cache();
		$this->vism->P0 = $this->session->userdata('matricula');
		$this->vism->execute("D GETPREFIL^VBLOGIN(P0,.P9)");
		
		return str_replace("|", "\n", $this->vism->P9);	
	}
	
	public function setEstadoEnfermero($matricula, $idservicio)
	{
		$this->vism->borrar_cache();
		$this->vism->P0 = $matricula;
		$this->vism->P1 = $idservicio;
		$this->vism->execute("D ESENFERMERO^HCDIGITAL(P0,P1,.P9)");

		if($this->vism->P9 == "1")
		{
			$this->session->set_userdata('enfermeria', '1');
		}
		else
		{
			$this->session->set_userdata('enfermeria', '0');
		}
	}
	
	# No se usa desde tiempos inmemorables 
	/*
	public function get_user_id_from_username($dni) {
		return 0;
	}
	
	public function get_user($user) {

		$sql = "CALL SP_GetUsuario(?)";
		$parametros = array($user);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		return $resultado;
	
	}
	
	private function hash_password($password) {
		return md5($password);
	}

	private function verify_password_hash($password, $hash) {
		return password_verify($password, $hash);
	}

	public function comprobar_correo($documento, $correo) {
		
		$sql = "CALL SP_ComprobarCorreo(?,?)";
		$parametros = array($documento, $correo);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		if ($resultado->resul == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	public function renovarPassword($documento) {
		
		$sql = "CALL SP_RestablecerPassword(?)";
		$parametros = array($documento);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		return $resultado->pass;
		
	}
	
	public function resolve_user_login($username, $password) {
		$parametros = array(
			'usuario' => $username, 
			'pass' => $password);
	
		$this->curl->set_content_type('application/json');
		$data = $this->curl->simple_post(getWebService() . 'login', $parametros);		
		return json_decode(utf8_encode($data));
	}
	*/
	
}
