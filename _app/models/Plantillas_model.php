<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Plantillas_model extends CI_Model
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
	
	public function listaPlantillas()
	{
		$this->vism->borrar_cache();
		$this->vism->P0 = $this->session->userdata('id_servicio');        
        $this->vism->P1 = $this->session->userdata('matricula');
		$this->vism->P3 = $this->session->userdata('matricula');
		
		$this->vism->execute("D LISTAPLANTILLAS^HCWEB(P0,P1,P2,P3)","HCWEB",$this->vism->P3);
        return array('cols' => $this->vism->P9,'global' => $this->vism->global);				
	}
	
    public function detallePlantilla($id)
    {
        $this->vism->borrar_cache();
		$this->vism->P0 = $id;
        $this->vism->P2 = $this->session->userdata('matricula');
		
		$this->vism->execute("D DETALLEPLANTILLA^HCWEB(P0,P2,.P9)","HCWEB",$this->vism->P2);
		return array('cols' => $this->vism->P9,'global' => $this->vism->global);				
    }

    public function grabarPlantilla($params = array())
    {
        $this->vism->borrar_cache();
        $this->vism->P0 = $param['id'];
        $this->vism->P1 = $param['nombre'];
        $this->vism->P2 = $param['campos'];
        
        $this->vism->P3 = $this->session->userdata('matricula');

        $this->vism->execute("D GRABARPLANTILLA^HCWEB(P0,P1,P2,P3,.P9)");
        return $this->vism->P9;
    }

    public function grabarCampo($params = array())
    {
        $this->vism->borrar_cache();
        $this->vism->P0 = $param['id'];
        $this->vism->P1 = $param['nombre'] ."^".$param['tipo']."^".$param['tamano']."^".$param['obligatorio'];
        $this->vism->P2 = $param['valores'];
        $this->vism->P3 = $this->session->userdata('matricula');

        $this->vism->execute("D GRABARCAMPO^HCWEB(P0,P1,P2,P3,.P9)");
        return $this->vism->P9;
    }



    public function listaCampos()
    {
        $this->vism->borrar_cache();
		$this->vism->P0 = $this->session->userdata('matricula');		
        $this->vism->execute("D LISTACAMPOS^HCWEB(P0,.P9)","HCWEB",$this->vism->P0);
        
        return array('cols' => $this->vism->P9,'global' => $this->vism->global);				
        
    }
}
