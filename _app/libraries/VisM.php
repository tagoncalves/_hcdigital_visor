<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter VisM Class
 
 * Emula el OCX VisM, funciona con un httpServer que recibe las peticiones y responde en formato JSON.
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Facundo Albesa
 */
 
 
 // ACTUALIZADO 2018-08-21
class VisM {

	protected $CI;                 // Instancia de CodeIgniter 
	protected $response = '';       // Contains the cURL response for debug
	
	protected $http = '';
    protected $mserver = ''; 
    protected $namespace = '';

    public $P0 = '';
    public $P1 = '';
    public $P2 = '';
    public $P3 = '';
    public $P4 = '';
    public $P5 = '';
    public $P6 = '';
    public $P7 = '';
    public $P8 = '';
    public $P9 = '';
    
    public $error = '';
    public $error_name = '';
	
    public $global = '';

    function __construct($params)
	{
		$this->CI = & get_instance();
        
		log_message('debug', 'VisM Iniciado');

		if ( ! $this->is_enabled())
		{
			log_message('error', 'VisM Class - VisM requiere cUrl para funcionar');
		}

        $this->mserver = $params['mserver'];
        $this->namespace = $params['namespace'];
        $this->http = $params['http_server'];
        $this->port = $params['port']; 
	}

    public function borrar_cache()
    {
        $this->P0 = '';
        $this->P1 = '';
        $this->P2 = '';
        $this->P3 = '';
        $this->P4 = '';
        $this->P5 = '';
        $this->P6 = '';
        $this->P7 = '';
        $this->P8 = '';
        $this->P9 = '';
        $this->global = '';
        $this->error = '';
        $this->error_name = '';
        log_message('debug', 'Variables borradas');
    }

    public function set_namespace($namespace)
    {
        $this->namespace = $namespace;
        log_message('debug', 'Namespace cambiado a ' . $namespace);
    }

    public function set_mserver($mserver)
    {
        $this->mserver = $mserver;
        log_message('debug', 'MServer cambiado a ' . $namespace);
    }

    public function execute($code, $global = '', $global_index = '')
    {
        $param = array(
			'P0' => $this->P0,
			'P1' => $this->P1,
			'P2' => $this->P2,
			'P3' => $this->P3,
			'P4' => $this->P4,
			'P5' => $this->P5,
			'P6' => $this->P6,
			'P7' => $this->P7,
			'P8' => $this->P8,
			'P9' => $this->P9,
			'code' => $code,
			'global' => $global,
			'mserver' => $this->mserver,
			'namespace' => $this->namespace,
			'global_index' => $global_index              
		);

		try{
			$url = "http://" . $this->http . ":" . $this->port;
			
			if($this->http == "" || $this->port == ""){
				throw new Exception('Url Error');
			}
			
			$data = $this->CI->curl->simple_post($url . '/Ejecutar', $param);	
		   
			$data = str_replace("\\","\\\\", $data);
			for ($i = 0; $i <= 31; ++$i) {
				$data = str_replace(chr($i), "", $data);
			}
		
			$this->response = json_decode(utf8_encode($data));
			
			if(is_object($this->response)){
				$this->P0 = urldecode($this->response->params->P0);
				$this->P1 = urldecode($this->response->params->P1);
				$this->P2 = urldecode($this->response->params->P2);
				$this->P3 = urldecode($this->response->params->P3);
				$this->P4 = urldecode($this->response->params->P4);
				$this->P5 = urldecode($this->response->params->P5);
				$this->P6 = urldecode($this->response->params->P6);
				$this->P7 = urldecode($this->response->params->P7);
				$this->P8 = urldecode($this->response->params->P8);
				$this->P9 = urldecode($this->response->params->P9);

				$this->error = urldecode($this->response->errors->error);
				$this->error_name = urldecode($this->response->errors->errorname);

				$this->global = $this->response->global;
			}else{
				$this->borrar_cache();
			}
		}catch (Exception $e) {
			$this->borrar_cache();
			$this->error_name = $e;
		}
    }


	public function is_enabled()
	{
		return function_exists('curl_init');
	}
}

/* End of file VisM.php */
/* Location: ./application/libraries/VisM.php */