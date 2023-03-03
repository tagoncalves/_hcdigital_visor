<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Nombre:  Agenda Model
* Version: 1.0
* Autor:  Facundo Ezequiel Albesa
* Created:  18.08.2015

* Descripcion:  Modelo para Agenda de pacientes del sistema de Historia Clinica Digital
*
* Changelog: 
*
* *  18.08.2015 : Startup
* *  15.09.2015 : Se agregaron funciones getPaciente, getAntecedentes y getDiagnostico
*
*/

class Agenda_model extends CI_Model
{
	public function __construct(){
		parent::__construct();		

		$config = array(
			'mserver' => MSERVER,
			'namespace' => MNAMESPACE, 			
			'http_server' => IP_WS,
			'port' => RandPortWS()
		);
		
		$this->load->library('VisM',$config);
	}
	
	public function cargarAgendaBis(){
		// TESTING. OJO CON EL UTF8
		
		$this->vism->borrar_cache();
		$this->vism->P0 = $this->session->userdata('matricula');
		$this->vism->P1 = date("Ymd");
		$this->vism->P2 = $this->session->userdata('id_servicio');

		# MATRICULA, FECHA, ID_SERV, DATOS, CANT
		$this->vism->execute("D CONSMEDICO^VBTURSLLX(P0,P1,P2,.P8,.P9)");

		$ret = array ();
		/*if($this->vism->P9 != ""){
			if($this->vism->P9 != "0"){
				$agenda = explode("^", $this->vism->P8);
			
				foreach($agenda as $paciente){
					$datosPac = explode("!", $paciente);
					array_push($ret, $datosPac);
				}
			}
		}*/

		return $this->vism->P8;
	}
	
	public function cargarAgenda(){
		$this->vism->borrar_cache();
		$this->vism->P0 = $this->session->userdata('matricula');
		$this->vism->P1 = date("Ymd");
		$this->vism->P2 = $this->session->userdata('id_servicio');

		# MATRICULA, FECHA, ID_SERV, DATOS, CANT
		$this->vism->execute("D CONSMEDICO^VBTURSLLX(P0,P1,P2,.P8,.P9)");

		$ret = array ();
		if($this->vism->P9 != ""){
			if($this->vism->P9 != "0"){
				$agenda = explode("^", utf8_encode($this->vism->P8));
			
				foreach($agenda as $paciente){
					$datosPac = explode("!", $paciente);
					array_push($ret, $datosPac);
				}
			}
		}

		return $ret;
	}

	public function cargarAgendaEnfermeria(){
		$this->vism->borrar_cache();
		$this->vism->P0 = $this->session->userdata('matricula');
		$this->vism->P1 = $this->session->userdata('id_servicio');
		$this->vism->P2 = ""; // FECHA

		$this->vism->execute("D CONSENFERMERIA^HCDIGITAL(P0,P1,.P9)", "^HCDIGITALWEB", $this->session->userdata('matricula'));

		return $this->vism->global;
	}
	
	public function getPregunta(){
		$this->vism->borrar_cache();
		$this->vism->P0 = $this->session->userdata('matricula');
		$this->vism->P1 = $this->session->userdata('id_servicio');
		
		$this->vism->execute("D PREGUNTA^HCDIGITAL(P0,P1,.P8,.P9)");

		$ret["pregunta"] = $this->vism->P8;
		$ret["comentario"] = $this->vism->P9;
		
		return $ret; 
	}
	
	public function setRespuesta($res, $text){
		$this->vism->borrar_cache();
		$this->vism->P0 = $this->session->userdata('matricula');
		$this->vism->P1 = $this->session->userdata('id_servicio');
		$this->vism->P2 = $res;
		$this->vism->P3 = $text;
		
		$this->vism->execute("D SETRESPUESTA^HCDIGITAL(P0,P1,P2,P3,.P9)");

		$ret["error"] = $this->vism->P9;
		
		return $ret; 
	}
	
	public function imagenVM($id){
		$param = '{
					"datosEstudioABuscar": {
						"estudioaccessionnumber": "' . $id . '"
					}
				}';		
		$urlVM = "http://10.11.0.44/webservicewl/index.php/acciones/url1turno";
		$data = $this->curl->simple_post($urlVM, $param);		
		return json_decode(utf8_encode($data));		
	}

	public function getIngreso($ingreso = '', $hc = ''){
		$this->vism->borrar_cache();
		$this->vism->P0 = $hc;
		$this->vism->P1 = $ingreso;

		# HC, INGRESO, DATOS
		$this->vism->execute("D PACIENTE^VBTURSLL(P0,P1,.P9)");

		return explode("^", utf8_encode($this->vism->P9));
	}
	
	public function getAntecedentes($hc = ''){
		$matricula = $this->session->userdata('matricula');
		
		//$index = $matricula . $hc;
		$index = $matricula;
		
		$this->vism->borrar_cache();
		$this->vism->P0 = $hc;
		$this->vism->P1 = $index; 

		# HC, DATOS, CANT
		$this->vism->execute("D GETANTECEDENTES^HCDIGITALWEB(P0,P1,.P9)","^HCDIGITALWEB",$index);
		
		
		
		return $this->vism->global;
	}
	
	public function getInforme($id = ''){
		# En donde tire error hay que pasar la llamada al modelo de Estudios
		/*$param = array('id' => $id);
		$data = $this->curl->simple_post(getWebService() . 'GetInforme', $param);		
		return json_decode(utf8_encode($data));*/
	}
	
	public function getProblemas($hc = ''){
		$this->vism->borrar_cache();
		$this->vism->P0 = $hc;

		# HC, DATOS, CANT
		$this->vism->execute("D GETPROBLEMAS3^HCDIGITAL(P0,.P8,.P9)");

		if($this->vism->P9 != "0"){
			$ret = array ();
			$problemas = explode("|", utf8_encode($this->vism->P8));
			foreach($problemas as $problem){
				$data = explode("^", $problem);
				array_push($ret, $data);
			}
		}else{
			$ret = null;
		}

		return $ret; 
	}
	
	public function getDiagnostico($id = '',$sector = '',$sede = ''){
		$this->vism->borrar_cache();
		$this->vism->P0 = $id . "^" . $sede . "^" . $sector;
		$this->vism->execute("D GETCONSULTA^WEBAGENDA(P0,.P6,.P7,.P8,.P9)");
		
		$ret = Array();
		$this->vism->P6 = str_replace("\n", "",str_replace("\r", "", trim($this->vism->P6)));
		$this->vism->P7 = str_replace("\n", "",str_replace("\r", "", trim($this->vism->P7)));
		$this->vism->P8 = str_replace("\n", "",str_replace("\r", "", trim($this->vism->P8)));
		$this->vism->P9 = str_replace("\n", "",str_replace("\r", "", trim($this->vism->P9)));
		
		if($this->vism->P6 != ""){
			$tmp = explode("^", utf8_encode($this->vism->P6));
			array_push($ret, $tmp[0]);
			array_push($ret, $tmp[1]);
		}else{
			array_push($ret, "");
			array_push($ret, "");
		}
		array_push($ret, $this->vism->P7);
		array_push($ret, $this->vism->P8);
		array_push($ret, $this->vism->P9);
		
       return $ret;
	}

	public function listaMamoHC($ingreso, $hc){
		$this->vism->borrar_cache();
		$this->vism->P0 = $hc."^".$ingreso;
		
		$this->vism->execute("D LISTAMAMOHC^HCDIGITAL(P0,.P9)");
		
		return explode("|", utf8_encode($this->vism->P9));
	}

	public function grabaMamoHC($cab, $ant, $eg, $fc, $punc, $cir, $est){
		$this->vism->borrar_cache();
		$this->vism->P0 = $cab;
		$this->vism->P1 = $ant;
		$this->vism->P2 = $eg;
		$this->vism->P3 = $fc;
		$this->vism->P4 = $punc;
		$this->vism->P5 = $cir;
		$this->vism->P6 = $est;
		
		$this->vism->execute("D GRABAMAMOHC^HCDIGITAL(P0,P1,P2,P3,P4,P5,P6,.P9)");

		$res = [];
		if($this->vism->P9 == "0"){
			$res["ban"] = true;
			$res["res"] = "";
		}else{
			$res["ban"] = false;
			$res["res"] = $this->vism->P9;
		}

		return $res;
	}

	public function getMamoHC($cab){
		$this->vism->borrar_cache();
		$this->vism->P0 = $cab;
		
		$this->vism->execute("D GETMAMOHC^HCDIGITAL(P0,.P1,.P2,.P3,.P4,.P5,.P6,.P7,.P9)");
		
		$res["antecedentes"] = $this->vism->P1;
		$res["eg"] = $this->vism->P2;
		$res["fc"] = $this->vism->P3;
		$res["puncion"] = $this->vism->P4;
		$res["cirugia"] = $this->vism->P5;
		$res["estudios"] = $this->vism->P6;
		$res["matricula"] = $this->vism->P7;

		return $res;
	}
	
	public function getDiagnosticoMamografia($id = ''){
		$this->vism->borrar_cache();
		$this->vism->P0 = $id;
		
		$this->vism->execute("D GETCONSULTAMAMO^HCDIGITAL(P0,.P8,.P9)");
		
		if ($this->vism->P8!="" && $this->vism->P9!="")
		{
			$data = array(
				'diagnostico' => explode("|", utf8_encode($this->vism->P8)),
				'preguntas' => explode("|", utf8_encode($this->vism->P9))
			);
			
			$arr = explode("^",$data["preguntas"][5]);
			$arr[1] = $this->jul2fec($arr[1]);
			$data["preguntas"][5] = $arr[0]."^".$arr[1]."^".$arr[2]."^".$arr[3]."^".$arr[4];
			
			$arr = explode("^",$data["preguntas"][6]);
			$arr[1] = $this->jul2fec($arr[1]);
			$data["preguntas"][6] = $arr[0]."^".$arr[1]."^".$arr[2]."^".$arr[3];
			
			return $data;
		}
		else
		{
			return "";
		}
		
	}
	
	public function grabarDiagnostico($tipo,$motivo,$diagnostico,$plan,$turno,$ingreso,$hc,$id,$objetivos){
		$this->vism->borrar_cache();
		
		
		if($ingreso != ""){
			$this->vism->P1 = $tipo."|".$motivo."|".$plan."|".$diagnostico."|".$turno;
			$this->vism->P1 .= "|".$ingreso."|".$this->session->userdata('id_servicio')."|".$objetivos;
			if ($id == ""){
				$this->vism->P0 = $hc;
				$this->vism->P2 = $this->session->userdata('matricula');
				$this->vism->execute("D INSCONSULTA^CSPHC001(P0,P1,P2,.P9)");
			}else{
				$this->vism->P0 = $id;
				$this->vism->execute("D UPDCONSULTA^CSPHC001(P0,P1,.P9)");
			}
			
			$ret["id"] = "";
			if($this->vism->P9 <> ""){
				if($this->vism->P9 <> "0"){
					$ret["id"] = $this->vism->P9;
				}else{
					$ret["errores"] = "Error al grabar en la base de datos.";
				}
			}else{
				$ret["errores"] = "Se produjo un error interno.";
			}
		}else{
			$ret["errores"] = "No se pudo realizar la operacion solicitada.";
		}

		return $ret;
	}	

	public function grabarEnfermeria($hc, $turno, $ingreso, $evolucion)
	{
		$this->vism->borrar_cache();
		$this->vism->P0 = $hc."^".$turno."^".$this->session->userdata("matricula")."^".$ingreso;
		$this->vism->P1 = $evolucion;
		$this->vism->execute("D SETEVOENFERMERIA^HCDIGITAL(P0,P1,.P9)");
		
		if($this->vism->P9 == "0")
		{
			$ret["ban"] = "0";
		}
		else
		{
			$ret["errores"] = "Se produjo un error interno.";
		}

		return $ret;
	}	

	public function getEnfermeria($hc, $ingreso, $turno)
	{
		$this->vism->borrar_cache();
		$this->vism->P0 = $hc."^".$turno."^".$this->session->userdata("matricula")."^".$ingreso;
		$this->vism->execute("D GETEVOENFERMERIA^HCDIGITAL(P0,.P9)");

		return (str_replace("|", "\n", $this->vism->P9));
	}

	public function grabarDiagnosticoMamo($diagnostico,$antecedentes,$preguntas,$ingreso,$hc,$id){
		
		$this->vism->borrar_cache();
		$this->vism->P0 = $ingreso . "^" . $hc . "^" . $this->session->userdata('matricula') . "^" . $this->session->userdata('id_servicio') . "^" . $id;
		$this->vism->P1 = $diagnostico . "|" . $antecedentes;
		$this->vism->P2 = $preguntas;

		$this->vism->execute("D INSCONSULTAMAMO^HCDIGITAL(P0,P1,P2,.P9)");
		
		return $this->vism->P9;
	}
	
	public function fec2jul($fecha){	
		#Recibe fecha en formato yyyymmdd y la pasa a juliano
		
		$this->vism->borrar_cache();
		$this->vism->P0 = $fecha;
		
		if($this->vism->P0 != ""){ 
			$this->vism->execute('S P9=$$JUL^%ZUDI(P0)');
		}
		
		return $this->vism->P9;
	}
	
	public function jul2fec($jul){	
		#Recibe fecha en formato juliano y la pasa a formato yyyymmdd
		
		$this->vism->borrar_cache();
		$this->vism->P0 = $jul;
		
		if($this->vism->P0 != ""){ 
			$this->vism->execute('S P9=$$FEC^%ZUDI(P0)');
		}
		
		return $this->vism->P9;
	}
	
	public function grabarProblema($fecha,$texto,$estado,$hc,$id) {
		$this->vism->borrar_cache();
		$this->vism->P0 = $hc;
		$this->vism->P1 = $fecha."^".$texto."^".$estado;
		$this->vism->P2 = $this->session->userdata('matricula');
		$this->vism->P3 = $id;
		$this->vism->execute("D INSPROBLEMA^HCDIGITAL(P0,P1,P2,P3,.P9)");
		
		$ret["id"] = "";
		if($this->vism->P9 <> ""){
			if($this->vism->P9 <> "0"){
				$ret["id"] = $this->vism->P9;
			}else{
				$ret["errores"] = "Error al grabar en la base de datos.";
			}
		}else{
			$ret["errores"] = "Se produjo un error interno.";
		}

		return $ret;
	}

	public function filtroPaciente($hc, $nombre, $dni){
		$this->vism->borrar_cache();
		$this->vism->P0 = $hc;
		$this->vism->P1 = $nombre;
		$this->vism->P2 = $dni;

		# MATRICULA, FECHA, ID_SERV, DATOS, CANT
		$this->vism->execute("D BUSCAPACWEB^VBTURSLLX(P0,P1,P2,.P8,.P9)");

		$agenda = explode("|", utf8_encode($this->vism->P8));
		$ret = array ();
		foreach($agenda as $paciente){
			$datosPac = explode("^", $paciente);
			array_push($ret, $datosPac);
		}

		return $ret;
	}
	
	public function llamarPac($comp, $mat, $box, $serv, $oficina){
		$this->vism->borrar_cache();
		$this->vism->P0 = $comp;
		$this->vism->P1 = $mat;
		$this->vism->P2 = $box;
		$this->vism->P3 = $serv;
		$this->vism->P4 = $oficina;

		$this->vism->execute("D LLAMAPAC^VBTURSLLX(P0,P1,P2,P3,.P9,P4)");
		return $this->vism->P9;
	}

	public function noLlamarPac($comp, $mat, $box, $serv, $oficina){
		$this->vism->borrar_cache();
		$this->vism->P0 = $comp;
		$this->vism->P1 = $mat;
		$this->vism->P2 = $box;
		$this->vism->P3 = $serv;
		$this->vism->P4 = $oficina;
	
		$this->vism->execute("D NOLLAMAPAC^VBTURSLLX(P0,P1,P2,P3,.P9,P4)");
		return $this->vism->P9;	
	}

	public function grabarAdjunto($hc, $hcint, $matricula, $diag, $path, $afiliado, $prepaga)
	{
		$this->vism->borrar_cache();
		$this->vism->P0 = $hc;
		$this->vism->P1 = $hcint;
		$this->vism->P2 = $matricula;
		$this->vism->P3 = $diag;
		$this->vism->P4 = $path;
		$this->vism->P5 = $afiliado;
		$this->vism->P6 = $prepaga;

		$this->vism->execute("D GRABARADJUNTO^HCDIGITAL(P0,P1,P2,P3,P4,P5,P6)");
	}

	public function getArchivosAnt($hc, $json = true)
	{
		$this->vism->borrar_cache();
		$this->vism->P0 = $hc;
		$this->vism->P1 = $this->session->userdata('matricula');

		$this->vism->execute("D GETARCHIVOSHC^HCDIGITALWEB(P0,P1,.P9)", "^HCDIGITALWEB", $this->session->userdata('matricula'));

		$data = [];
		if($this->vism->P9 == "0")
		{
			$data = $this->vism->global;
		}

		if($json)
		{
			return json_encode($data);
		}
		else
		{
			return $data;
		}
	}

	public function getParte($hc, $id)
	{
		// Copiado de laslomas.com.ar/honorarios		
		$this->vism->borrar_cache();
			
        $this->vism->P0 = $hc . "^" . $id;
		
		$this->vism->execute("D CARGAPARTE^VBINTERNACION(P0,.P1,.P2,.P3,.P4,.P5,.P6,.P7,.P8,.P9)");
		
		If($this->vism->P8 == "0"){
			$datos["diagnostico"] = $this->vism->P1;
			$datos["profesionales"] = $this->vism->P2;
			$datos["titulo"] = $this->vism->P3;
			
			$texto = $this->vism->P4;
			
			$textobis = separa($texto, "fs24", 2);
			
			if($textobis == ""){
				$texto = separa($texto, "fs23", 2);
			}else{
				$texto = $textobis;
			}
			
			$texto = str_replace("\par", " ", $texto); //<br>
			$texto = str_replace("|", "", $texto);
			$texto = str_replace("\'f3", "&oacute;", $texto);
			$texto = str_replace("\'e9", "&eacute;", $texto);
			$texto = str_replace("\'ed", "&iacute;", $texto);
			$texto = str_replace("\'e1", "&aacute;", $texto);
			$texto = str_replace("d\ltrpar\qc", "", $texto); //<div class='centered'>
			$texto = str_replace("}", "", $texto);
			$texto = str_replace("d\qc", "", $texto);
			$texto = str_replace("\\", "", $texto);
			$texto = str_replace("'f1", "ñ", $texto);
			//$texto .= "</div>";
			
			
			$datos["rtb"] = $texto;
			$datos["procedimiento"] = $this->vism->P5;
			$datos["honorarios"] = $this->vism->P6;
			//sId = .P7
			//sProfesional = .P9 & "^" & GetDatosMatricula(.P9)
			$datos["profesional"] = $this->vism->P9."^".$this->getProfesional($this->vism->P9);
			$datos["hc"] = $hc;
		}Else{
			$datos = "";
		}
		
		return $datos;
	}
	
	public function getDatosPac($hc)
	{
		// Copiado de laslomas.com.ar/honorarios	
		$this->vism->borrar_cache();

		$this->vism->P0 = $hc;
		
		$this->vism->execute("D GETDATOS^VBINTERNACION(P0,.P9)");

        return $this->vism->P9;
	}

	public function getProfesional($mat){
		
		$this->vism->borrar_cache();

		$this->vism->P0 = $mat;

		$this->vism->execute("D GETMEDICO^VBINTERNACION(P0,.P9)");

        return $this->vism->P9;
	}
}
