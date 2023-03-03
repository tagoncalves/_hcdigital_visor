<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plantillas extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		if ($this->session->userdata('login') == null) 
		{
			redirect('user/login');			
		}
	} 

	public function index()
	{
        $data['page'] = 'plantillas';
		$data['page_title'] = 'Historia Cl&iacute;nica';
		$data['user'] = $this->session->userdata('username');
				
        $this->load->view('inc/header',$data);
        $this->load->view('inc/menu',$data);
        $this->load->view('plantillas/plantillas');
        $this->load->view('inc/footer',$data);
    
    }
    
	public function plantilla($id = "")
	{
		$data['page'] = 'plantillas';
		$data['page_title'] = 'Historia Cl&iacute;nica';
		$data['user'] = $this->session->userdata('username');
				
        $this->load->view('inc/header',$data);
        $this->load->view('inc/menu',$data);
        $this->load->view('plantillas/abm');
        $this->load->view('inc/footer',$data);
	
	}
}
