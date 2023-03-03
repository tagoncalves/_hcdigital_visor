<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Nombre:  Turnos Model
*
* Version: 1.0
*
* Autor:  Facundo Albesa
*
* Created:  10.09.2015
*
* Changelog: 
*
* *  10.09.2015 : Startup
*
* Descripcion:  Modelo para Turnos de pacientes del sistema de Historia Clinica Digital
*
*/

class Turnos_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
		$config = array(
			'mserver' => MSERVER,
			'namespace' => MNAMESPACE, 
			'http_server' => IP_WS,
			'port' => RandPortWS()
		);
		
		$this->load->library('VisM',$config);
	}
	
	public function getDisponibilidad($desde = "", $hasta = "") {
		if ($desde == "") {
			$desde = date('Ymd');
		}else{
			$aux = new DateTime($desde);
			$desde = $aux->format('Ymd');
		}
	
		if ($hasta == ""){
			$aux = new DateTime();
			$aux->add(new DateInterval('P7D'));
			$hasta = $aux->format('Ymd');
		}else{
			$aux = new DateTime($hasta);
			$hasta = $aux->format('Ymd');
		}

		$index = "HCWEB".$this->session->userdata('matricula');
		$this->vism->borrar_cache();
		$this->vism->P0 = $this->session->userdata('id_servicio');
		$this->vism->P1 = "0700";
		$this->vism->P2 = "2100";
		$this->vism->P3 = $desde;
		$this->vism->P4 = $hasta;
		$this->vism->P5 = $this->session->userdata('matricula') ;
		$this->vism->P6 = $index;
		
		# SERVICIO, HORA_DESDE, HORA_HASTA, FECHA_DESDE, FECHA_HASTA, , , MATRICULA, USUARIO 
		$this->vism->execute("D DISP^VBTURNOSXX(P0,P1,P2,P3,P4,.P8,.P9,P5,P6)", "^DISPVB", $index);

		return $this->vism->global;	
	}

	public function grabarTurno($reg,$fecha,$hora)
	{
		$this->vism->borrar_cache();
		$this->vism->P0 = $reg;
		$this->vism->P1 = $this->session->userdata('id_servicio');
		$this->vism->P2 = $this->session->userdata('matricula');
		$this->vism->P3 = $fecha;
		$this->vism->P4 = $hora;

		# REGISTRO, SERVICIO, MATRICULA, FECHA, HORA, .BAN
		$this->vism->execute("D TURNOWEB^VBTURNOSXX(P0,P1,P2,P3,P4,.P9)");
		
		if($this->vism->P9 == "0"){
			$ret["MSG"] = "Turno ".substr($fecha, 6, 2)."/".substr($fecha, 4, 2)."/".substr($fecha, 0, 4)." - ".$hora." asignado correctamente";
		}else{
			$ret["ERROR"] = "Se produjo un error interno.";
		}

		return $ret;
	}
	
}
