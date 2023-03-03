<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudios_model extends CI_Model {


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

	public function getEstudios($hc){	
		/*$params = array('hc' => $hc);
		
		$data = $this->curl->simple_post(getWebService() . 'GetEstudios', $params);				
		return json_decode(utf8_encode($data));*/

		$res = array();
		
		if($hc == ""){
			return $res;
		}
		
		$this->vism->borrar_cache();
		$this->vism->P0 = $hc;
		$this->vism->P1 = "A";
		
		/*$this->vism->execute("D INFORMESXCOMP^VBPVISUALA(P0,P1,.P8,.P9)");*/
		$this->vism->execute("D GETINFO^HCDIGITAL(P0,.P8,.P9)");

		$cant = (int) $this->vism->P9;
		$datos = utf8_encode($this->vism->P8);

		$res = array();
		for($i = 1; $i <= $cant; $i++){
			$this->vism->borrar_cache();
			$cabecera = "";
			$arr = "";

			$temp = separa($datos, "|", $i);
			$id = separa($temp, "^", 6);
			$sector = separa($temp, "^", 9);
			
			$this->vism->P0 = $id;
			$this->vism->set_namespace(GetNamespaceInformes($sector));
			$this->vism->execute("D GETINFORME^".GetRutinaInformes($sector)."(P0,.P7,.P8,.P9)");

			$cabecera = utf8_encode($this->vism->P7);
			$arr["FECPET"] = separa($cabecera, "^", 3);
			$arr["FECEXT"] = "";
			$arr["PRO"] = $id;
			$arr["SOL"] = separa($cabecera, "^", 4)." - ".separa($cabecera, "^", 5);
			$arr["SEC"] = $sector;
			$arr["EST"] = "";
			$arr["FECRES"] = "";

			array_push($res, $arr);
		}

		return $res;
	}
	
	public function getInforme($protocolo, $sector){
		/*$params = array(	
			'protocolo' => $protocolo,
			'sector' => $sector
		);
		
		$data = $this->curl->simple_post(getWebService() . 'GetInforme', $params);				
		return json_decode(utf8_encode($data));*/

		$this->vism->borrar_cache();
		$this->vism->P0 = $protocolo;
		$this->vism->set_namespace(GetNamespaceInformes($sector));
		$this->vism->execute("D GETINFORME^".GetRutinaInformes($sector)."(P0,.P7,.P8,.P9)");

		$res ="";
		$res["fecha"] = separa($this->vism->P7,"^",3);
		$res["protocolo"] = $protocolo;
		$res["hc"] = separa($this->vism->P7,"^",12);
		$res["paciente"] = separa($this->vism->P7,"^",2);
		$res["prepaga"] = separa($this->vism->P7,"^",13);

		$res["informe"] = "";

		$temp = $this->vism->P8;
		$temp = str_replace("|", "<br>", $temp);
		$temp = separa($temp, "\\fs24", 2);
        $temp = str_replace("\\par", "<br>", $temp);
        $temp = str_replace("\\'f3", "&oacute;", $temp);
        $temp = str_replace("\\'e9", "&eacute;", $temp);
        $temp = str_replace("\\'ed", "&iacute;", $temp);
		$temp = str_replace("\\'e1", "&aacute;", $temp);
		$temp = str_replace("\\'f1", "&ntilde;", $temp);
        $temp = str_replace("d\\ltrpar\\qc", "<div class='centered'>", $temp);
        $temp = str_replace("}", "", $temp);
        $temp = str_replace("d\\qc", "", $temp);
        $temp = str_replace("\\", "", $temp);

		$res["informe"] = $temp;

		return $res; 
	}

	public function getToolbarEstudios(){
		// Devuelve las opciones par el toolbar de solicitud de estudios
		$this->vism->borrar_cache();

		// DATOS, CANTIDAD
		$this->vism->execute("D SECEST^HCDIGITAL(.P8,.P9)");

		return $this->vism->P8;	
	}

	public function listaEstudios($sec){
		// Lista los estudios disponibles para solicitar
		$this->vism->borrar_cache();
		$this->vism->P0 = $sec;
		
		// SEC, DATOS, CANTIDAD
		$this->vism->execute("D LISTAESTUDIOS^HCDIGITAL(P0,.P8,.P9)");

		return $this->vism->P8;	
	}

	public function getPasaje($hc){	
		# 11/04/2018. Ya no deberia ser necesaria la funcion
		$this->vism->borrar_cache();
		$this->vism->P0 = $hc;
		
		# NEW_HC, OLD_HC
		$this->vism->execute("D GETPASAJE^VBINTERNACION(P0,.P9)");
		$ret["pasaje"] = $this->vism->P9;
		return $ret;
	}

	/* ****** ****** ****** ****** ****** ****** ****** ****** */
	/* OBSOLETO, HAY QUE PASARLO A CACHE. 11/04/2018           */
	/* ****** ****** ****** ****** ****** ****** ****** ****** */
	public function getPeticionesLaboratorio($hc){
		/*
		$dbLabo = $this->load->database('laboratorio', TRUE);
		
		$sql = "CALL SP_SelectPeticionesxHistoria(?)";
		$parametros = array($hc);
		$consulta = $dbLabo->query($sql,$parametros);
		$resultado = $consulta->result();
		
		$consulta->next_result();
		$consulta->free_result();
		
		$dbLabo->close();
		return $resultado;
		*/
		return null;
	}

	public function getPeticionxProtocolo($peticion){
		
		/*$dbLabo = $this->load->database('laboratorio', TRUE);
		
		$sql = "CALL SP_SelectPeticionxProtocolo(?)";
		$parametros = array($peticion);
		$consulta = $dbLabo->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		$dbLabo->close();
		
		return $resultado;
		
		*/
		
		return null;
	}
	
	public function getResultadoLaboratorio($peticion){
		/*$dbLabo = $this->load->database('laboratorio', TRUE);
		
		$sql = "CALL SP_SelectResultadosLaboratorio(?)";
		$parametros = array($peticion);
		$consulta = $dbLabo->query($sql,$parametros);
		$resultado = $consulta->result();
		
		$consulta->next_result();
		$consulta->free_result();
		
		$dbLabo->close();
		
		return $resultado;
		*/
		return null;
	}
	
	public function getResultadoMicrobiologia($peticion){
		/*$dbLabo = $this->load->database('laboratorio', TRUE);
		
		$sql = "CALL SP_SelectResultadoMicrobiologia(?)";
		$parametros = array($peticion);
		$consulta = $dbLabo->query($sql,$parametros);
		$resultado = $consulta->result();
		
		$consulta->next_result();
		$consulta->free_result();
		
		$dbLabo->close();
		
		return $resultado;
		*/
		return null;
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
}