<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Agenda_model', 'agenda');
		$this->load->library('form_validation');
		$this->load->helper('download');

		if ($this->session->userdata('login') == null) {
			redirect('user/login');
		}
	}

	public function index()
	{
		if ($this->session->userdata('login') == null) {
			redirect('user/login');
		} else {
			redirect('agenda/consultaHC');
			$data['page'] = 'consultahc';
			$data['page_title'] = 'Historia Cl&iacute;nica';
			$data['user'] = $this->session->userdata('username');
			$data['img'] = $this->getProfileImage();
	
			$this->load->view('inc/header', $data);
			$this->load->view('inc/menu', $data);
			$this->load->view('agenda/consultaHc');
			$this->load->view('inc/footer', $data);
		}
	}

	public function getImageProfile($imgName)
	{
		$remoteImage = RUTA_PERFILES . $imgName;
		$imginfo = getimagesize($remoteImage);
		header("Content-type: {$imginfo['mime']}");
		readfile($remoteImage);
	}

	private function getProfileImage($prefix = '')
	{
		$path = RUTA_PERFILES . $this->session->userdata("matricula");

		$img = "";
		if (file_exists($path . ".jpg")) {
			$img = $prefix . "getImageProfile/" . $this->session->userdata("matricula") . ".jpg";
		}

		if (file_exists($path . ".png")) {
			$img = $prefix . "getImageProfile/" . $this->session->userdata("matricula") . ".png";
		}

		if ($img == "") {
			$img = $prefix . "getImageProfile/perfil.jpg";
		}

		return $img;
	}

	public function getPregunta()
	{
		$data = $this->agenda->getPregunta();

		echo json_encode($data);
	}

	public function setRespuesta()
	{
		$res = $this->input->post('res');
		$txt = $this->input->post('txt');

		$data = $this->agenda->setRespuesta($res, $txt);

		echo json_encode($data);
	}

	public function consultaHc()
	{
		$data['page'] = 'consultahc';
		$data['page_title'] = 'Historia Cl&iacute;nica';
		$data['user'] = $this->session->userdata('username');
		$data['img'] = $this->getProfileImage();

		$this->load->view('inc/header', $data);
		$this->load->view('inc/menu', $data);

		$this->load->view('agenda/consultaHc');
		$this->load->view('inc/footer', $data);
	}

	public function buscarPaciente()
	{
		$hc = $this->input->post('hc');
		$nombre = $this->input->post('nombre');
		$dni = $this->input->post('dni');

		$data['pacientes'] = $this->agenda->filtroPaciente($hc, $nombre, $dni);

		echo json_encode($data);
	}

	public function getImagenVM($id)
	{
		$data = $this->agenda->imagenVM($id);


		//echo json_encode($data);
		if (isset($data->url)) {
			#echo $data->url;
			echo $this->curl->simple_post(urldecode($data->url));
			#redirect(urldecode($data->url));
		}
	}

	public function cargarAgenda()
	{
		if ($this->session->userdata('enfermeria') == "1") {
			$datos = $this->agenda->cargarAgendaEnfermeria();
		} else {
			$datos = $this->agenda->cargarAgenda();
		}

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($datos));
	}

	public function cargarPaciente()
	{
		$ingreso = $this->input->post('ingreso');
		$hc = $this->input->post('hc');
		$diagnostico = $this->input->post('diagnostico');
		$turno = $this->input->post('turno');

		$data['ingreso'] = $this->agenda->getIngreso($ingreso, $hc);
		$data['saf'] = $ingreso;

		$data['hc'] = $hc;

		$data['antecedentes'] = $this->agenda->getAntecedentes($hc);
		$data['diagnostico'] = $this->agenda->getDiagnostico($diagnostico);
		$data['id'] = $diagnostico;
		$data['turno'] = $turno;

		$this->load->view('inc/datos_paciente', $data);
	}

	public function cargarDatosPac()
	{
		$ingreso = $this->input->post('ingreso');
		$hc = $this->input->post('hc');

		$data['ingreso'] = $this->agenda->getIngreso($ingreso, $hc);
		$data['saf'] = $ingreso;

		echo json_encode($data);
	}

	public function cargarDiagnosticoPac()
	{
		$ingreso = $this->input->post('ingreso');
		$hc = $this->input->post('hc');
		$diagnostico = $this->input->post('diagnostico');
		$turno = $this->input->post('turno');

		$data['hc'] = $hc;
		$data['saf'] = $ingreso;
		$data['id'] = $diagnostico;
		$data['turno'] = $turno;
		$data['diagnostico'] = $this->agenda->getDiagnostico($diagnostico);

		echo json_encode($data);
	}

	public function cargarDiagnosticoMamografia()
	{
		$ingreso = $this->input->post('ingreso');
		$hc = $this->input->post('hc');
		$diagnostico = $this->input->post('diagnostico');
		$turno = $this->input->post('turno');

		$data = $this->agenda->getDiagnosticoMamografia($diagnostico);
		$data['hc'] = $hc;
		$data['saf'] = $ingreso;
		$data['id'] = $diagnostico;
		$data['turno'] = $turno;

		echo json_encode($data);
	}

	public function cargarEnfermeria()
	{
		$ingreso = $this->input->post('ingreso');
		$hc = $this->input->post('hc');
		$turno = $this->input->post('turno');

		$data["evolucion"] = $this->agenda->getEnfermeria($hc, $ingreso, $turno);

		echo json_encode($data);
	}

	public function getAntecedenteMamo()
	{
		$registro = $this->input->post('registro');
		$hc = $this->input->post('hc');
		$mat = $this->input->post('matricula');
		$visor = $this->input->post('visor');

		if ($mat == "") {
			$mat = $this->session->userdata("matricula");
		}
		$cab = $hc . "^" . $registro . "^" . $mat;

		$data['datos'] = $this->agenda->getMamoHC($cab);
		$data['visor'] = $visor;

		$res["body"] = $this->load->view("inc/antecedenteMamo", $data, true);
		$res["footer"] = $this->load->view("inc/footerAntecedentesMamo", $data, true);
		$res['paciente'] = $this->agenda->getIngreso($registro, $hc);

		echo json_encode($res);
	}

	public function grabaMamografiaHC()
	{
		$registro = $this->input->post('reg');
		$hc = $this->input->post('hc');
		$mat = $this->session->userdata("matricula");
		$datos = $this->input->post('datos');

		$cab = $hc . "^" . $registro . "^" . $mat;
		$antecedentes = $datos["estado"] . "|";
		$antecedentes .= ($datos["quien"]["madre"] == "true" ? 1 : 0) . "^"; //((((bool)$datos["quien"]["madre"]) === true) ? 1 : 0 )."^"; //($datos["quien"]["madre"] ? 1 : 0 )."^";
		$antecedentes .= ($datos["quien"]["padre"] == "true" ? 1 : 0) . "^";
		$antecedentes .= ($datos["quien"]["hermana"] == "true" ? 1 : 0) . "^";
		$antecedentes .= ($datos["quien"]["hermano"] == "true" ? 1 : 0) . "^";
		$antecedentes .= ($datos["quien"]["abuela"] == "true" ? 1 : 0) . "^";
		$antecedentes .= ($datos["quien"]["abuelo"] == "true" ? 1 : 0) . "^";
		$antecedentes .= ($datos["quien"]["tios"] == "true" ? 1 : 0) . "^";
		$antecedentes .= ($datos["quien"]["primos"] == "true" ? 1 : 0) . "^";
		$antecedentes .= $datos["quien"]["otros"] . "|";
		$antecedentes .= ($datos["cancer_mama"] == "true" ? 1 : 0) . "^";
		$antecedentes .= ($datos["cancer_ovario"] == "true" ? 1 : 0) . "^";
		$antecedentes .= $datos["cancer_otro"];

		$eg = ($datos["estudio_genetico"] == "true" ? 1 : 0) . "|";
		if ($datos["estudio_genetico"] == "true") {
			$eg .= ($datos["eg_detalle"]["cual_brca1"] == "true" ? 1 : 0) . "^";
			$eg .= ($datos["eg_detalle"]["cual_brca2"] == "true" ? 1 : 0) . "^";
			$eg .= $datos["eg_detalle"]["cual_brcaOtro"] . "^";
			$eg .= ($datos["eg_detalle"]["motivo1"] == "true" ? 1 : 0) . "^";
			$eg .= ($datos["eg_detalle"]["motivo2"] == "true" ? 1 : 0) . "^";
			$eg .= ($datos["eg_detalle"]["motivo3"] == "true" ? 1 : 0) . "^";
			$eg .= ($datos["eg_detalle"]["motivo4"] == "true" ? 1 : 0) . "^";
			$eg .= $datos["eg_detalle"]["motivoOtro"];
		} else {
			$eg .= "^^^^^^^";
		}

		$eg .= "|" . ($datos["eg_familiar"] == "true" ? 1 : 0) . "|";
		if ($datos["eg_familiar"] == "true") {
			$eg .= ($datos["eg_flia_detalle"]["cual_brca1"] == "true" ? 1 : 0) . "^";
			$eg .= ($datos["eg_flia_detalle"]["cual_brca2"] == "true" ? 1 : 0) . "^";
			$eg .= $datos["eg_flia_detalle"]["cual_brcaOtro"];
		} else {
			$eg .= "^^";
		}

		$fecTemp = "";
		if ($datos["forma_clinica"]["fecha"] != "") {
			$fecTemp = explode("/", $datos["forma_clinica"]["fecha"]);
			$fecTemp = $fecTemp[2] . $fecTemp[1] . $fecTemp[0];
		}

		$fc = $fecTemp . "^";
		$fc .= $datos["forma_clinica"]["edad"] . "^";
		$fc .= $datos["forma_clinica"]["estado"] . "^";
		$fc .= $datos["forma_clinica"]["otro_estado"] . "^";
		$fc .= ($datos["forma_clinica"]["motFD1"] == "true" ? 1 : 0) . "^";
		$fc .= ($datos["forma_clinica"]["motFD2"] == "true" ? 1 : 0) . "^";
		$fc .= ($datos["forma_clinica"]["motFD3"] == "true" ? 1 : 0) . "^";
		$fc .= ($datos["forma_clinica"]["motFD4"] == "true" ? 1 : 0) . "^";
		$fc .= $datos["forma_clinica"]["fd_otro"] . "^";
		$fc .= ($datos["forma_clinica"]["motFD5"] == "true" ? 1 : 0) . "^";
		$fc .= ($datos["forma_clinica"]["motFD6"] == "true" ? 1 : 0) . "^";
		$fc .= ($datos["forma_clinica"]["motFD7"] == "true" ? 1 : 0) . "^";
		$fc .= $datos["forma_clinica"]["fd_otro2"];

		$fecTemp = "";
		if ($datos["puncion"]["fecha"] != "") {
			$fecTemp = explode("/", $datos["puncion"]["fecha"]);
			$fecTemp = $fecTemp[2] . $fecTemp[1] . $fecTemp[0];
		}

		$puncion = $datos["puncion"]["estado"] . "^";
		$puncion .= $fecTemp . "^";
		$puncion .= $datos["puncion"]["tipo"] . "^";
		$puncion .= $datos["puncion"]["localizacion"] . "^";
		$puncion .= $datos["puncion"]["resultado"] . "^";
		$puncion .= $datos["puncion"]["otroRes"];

		$fecTemp = "";
		if ($datos["cirugia"]["fecha"] != "") {
			$fecTemp = explode("/", $datos["cirugia"]["fecha"]);
			$fecTemp = $fecTemp[2] . $fecTemp[1] . $fecTemp[0];
		}

		$cirugia = $datos["cirugia"]["estado"] . "^";
		$cirugia .= $fecTemp . "^";
		$cirugia .= $datos["cirugia"]["tipo"] . "^";
		$cirugia .= $datos["cirugia"]["otro_tipo"] . "^";
		$cirugia .= $datos["cirugia"]["congelacion"] . "^";
		$cirugia .= $datos["cirugia"]["cong_otro"] . "^";
		$cirugia .= $datos["cirugia"]["pq"] . "^";
		$cirugia .= $datos["cirugia"]["pq_otro"];

		$estudios = "";
		if (isset($datos["estudios"])) {
			foreach ($datos["estudios"] as $arr) {
				if ($estudios !== "") {
					$estudios .= "|";
				}

				$estudios .= $arr[0] . "^";
				$estudios .= $arr[1] . "^";
				$estudios .= $arr[2] . "^";
				$estudios .= $arr[3] . "^";
			}
		}

		$res = $this->agenda->grabaMamoHC($cab, $antecedentes, $eg, $fc, $puncion, $cirugia, $estudios);

		echo json_encode($res);
	}

	public function cargarAntecedentesPac()
	{
		$hc = $this->input->post('hc');
		$ingreso = $this->input->post('ingreso');

		$data['antecedentes'] = $this->agenda->getAntecedentes($hc);
		$data['antecedentes_mamo'] = $this->agenda->listaMamoHC($ingreso, $hc);
		$data['archivosant'] = $this->agenda->getArchivosAnt($hc, false);
		$data['archivos'] = $this->getArchivos($hc);
		$data['adjuntos'] = $this->getAdjuntos($hc);
		$data['estudios'] = $this->getEstudios($hc);

		echo json_encode($data);
	}

	public function getInformesPac()
	{
		$this->load->model('estudios_model');
		$hc = $this->input->post('hc');
		$datos = $this->estudios_model->getEstudios($hc);

		echo json_encode($datos);
	}

	public function cargarInforme($id)
	{
		$data['informe'] = $this->agenda->getInforme($id);

		$this->load->view('inc/informe', $data);
	}

	public function cargarProblemas()
	{
		$hc = $this->input->post('hc');
		$data['problemas'] = $this->agenda->getProblemas($hc);

		echo json_encode($data);
	}

	public function cargarDiagnostico($ingreso)
	{
		$sector = $this->input->post('sector');
		$sede = $this->input->post('sede');
		$data['diagnostico'] = $this->agenda->getDiagnostico($ingreso, $sector, $sede);
		$this->load->view('inc/diagnostico', $data);
	}

	public function cargarDiagnosticoMamografiaVisor($ingreso)
	{
		$data['diagnostico'] = $this->agenda->getDiagnosticoMamografia($ingreso);
		$this->load->view('inc/diagnosticomamografia', $data);
	}
	public function cargarNota($hc)
	{
		$data['nota'] = $this->agenda->getNota($hc);
		echo json_encode($data);
	}

	public function getServicios()
	{
		return null;
	}

	public function cambiarServicio($servicio)
	{
		$this->session->set_userdata('id_servicio', $servicio);
		redirect('agenda');
	}

	public function grabarDiagnosticoMamografia()
	{
		$this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
		$this->form_validation->set_rules('mamo-diagnostico', 'motivo', 'trim|required');
		$this->form_validation->set_rules('mamo-antecedentes', 'antecedentes', 'trim|required');


		$this->form_validation->set_message('required', 'Campo <strong>%s</strong> es obligatorio');

		$errores = "";
		if (!$this->form_validation->run()) {
			$errores = validation_errors();

			$datos['errores'] = $errores;

			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($datos));
		} else {

			$diagnostico = strtoupper($this->input->post('mamo-diagnostico', FALSE));
			$diagnostico = str_replace("|", "/", $diagnostico);
			$diagnostico = str_replace("^", "'", $diagnostico);
			$diagnostico = str_replace("\"", "'", $diagnostico);
			$diagnostico = str_replace("\\", "/", $diagnostico);

			$antecedentes = strtoupper($this->input->post('mamo-antecedentes', FALSE));
			$antecedentes = str_replace("|", "/", $antecedentes);
			$antecedentes = str_replace("^", "'", $antecedentes);
			$antecedentes = str_replace("\"", "'", $antecedentes);
			$antecedentes = str_replace("\\", "/", $antecedentes);

			$ingreso = $this->input->post('mamo-ingreso');
			$hc = $this->input->post('mamo-hc');
			$id = $this->input->post('mamo-id');

			$hijos = ($this->input->post('mamo-hijos') == 'on' ? '1' : '0');
			$lactancia = ($this->input->post('mamo-lactancia') == 'on' ? '1' : '0');
			$hormonas = ($this->input->post('mamo-hormonas') == 'on' ? '1' : '0');
			$menopaucia = ($this->input->post('mamo-menopausia') == 'on' ? '1' : '0');

			$operaciones = ($this->input->post('mamo-operaciones') == 'on' ? '1' : '0');
			if ($operaciones === '1') {
				if (trim($this->input->post('mamo-fecoper')) == "") {
					$errores = "Debe ingresar fecha de operacion.";
				} else {
					$temp = explode("/", $this->input->post('mamo-fecoper'));
					$temp2 = $this->agenda->fec2jul(date('Ymd', strtotime($temp[2] . $temp[1] . $temp[0])));

					$operaciones .= "^" . $temp2 . "^";
					$operaciones .= ($this->input->post('mamo-operiz') == 'on' ? '1' : '0') . "^";
					$operaciones .= ($this->input->post('mamo-operder') == 'on' ? '1' : '0');
				}
			} else {
				$operaciones .= "^^0^0";
			}

			$punciones = ($this->input->post('mamo-punciones') == 'on' ? '1' : '0');
			if ($punciones === '1') {

				if (trim($this->input->post('mamo-fecpun')) == "") {
					$errores = "Debe ingresar fecha de puncion.";
				} else {
					$temp = explode("/", $this->input->post('mamo-fecpun'));
					$temp2 = $this->agenda->fec2jul(date('Ymd', strtotime($temp[2] . $temp[1] . $temp[0])));

					$punciones .= "^" . $temp2 . "^";
					$punciones .= ($this->input->post('mamo-puniz') == 'on' ? '1' : '0') . "^";
					$punciones .= ($this->input->post('mamo-punder') == 'on' ? '1' : '0') . "^";
					$punciones .= strtoupper($this->input->post('mamo-puncionObs'));
				}
			} else {
				$punciones .= "^^0^0^";
			}

			$tratamiento = ($this->input->post('mamo-tratamiento') == 'on' ? '1' : '0');
			if ($tratamiento === '1') {
				$tratamiento .= "^" . ($this->input->post('mamo-tamoxifeno') == 'on' ? '1' : '0') . "^";
				$tratamiento .= ($this->input->post('mamo-quimioterapia') == 'on' ? '1' : '0') . "^";
				$tratamiento .= ($this->input->post('mamo-radioterapia') == 'on' ? '1' : '0') . "^";
				$tratamiento .= ($this->input->post('mamo-acelerador') == 'on' ? '1' : '0') . "^";
				$tratamiento .= ($this->input->post('mamo-neoadyuvancia') == 'on' ? '1' : '0') . "^";
				$tratamiento .= strtoupper($this->input->post('mamo-otros'));
			} else {
				$tratamiento .= "^0^0^0^0^0^";
			}


			if ($errores != "") {
				$datos['errores'] = "<div class='alert'><button type='button' class='close' data-dismiss='alert'>�</button>$errores</div>";
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode($datos));
			} else {
				$preguntas = "$hijos|$lactancia|$tratamiento|$hormonas|$menopaucia|$punciones|$operaciones";


				$datos = $this->agenda->grabarDiagnosticoMamo($diagnostico, $antecedentes, $preguntas, $ingreso, $hc, $id);

				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode($datos));
			}
		}
	}

	public function grabarDiagnostico()
	{
		$this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
		$this->form_validation->set_rules('diag-motivo', 'motivo', 'trim|required');
		$this->form_validation->set_rules('diag-diagnostico', 'diagnostico', 'trim|required');
		$this->form_validation->set_rules('diag-plan', 'plan', 'trim|required');
		$this->form_validation->set_rules('diag-objetivos', 'datos-objetivos', 'trim|required');

		$this->form_validation->set_message('required', 'Campo <strong>%s</strong> es obligatorio');

		if (!$this->form_validation->run()) {
			$errores = validation_errors();

			$datos['errores'] = $errores;

			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($datos));
		} else {

			$tipo = $this->input->post('diag-tipo');

			$motivo = $this->input->post('diag-motivo', FALSE);
			$motivo = str_replace("|", "/", $motivo);
			$motivo = str_replace("^", "'", $motivo);
			$motivo = str_replace("\"", "'", $motivo);
			$motivo = str_replace("\\", "/", $motivo);

			$diagnostico = $this->input->post('diag-diagnostico', FALSE);
			$diagnostico = str_replace("|", "/", $diagnostico);
			$diagnostico = str_replace("^", "'", $diagnostico);
			$diagnostico = str_replace("\"", "'", $diagnostico);
			$diagnostico = str_replace("\\", "/", $diagnostico);

			$objetivos = $this->input->post('diag-objetivos', FALSE);
			$objetivos = str_replace("|", "/", $objetivos);
			$objetivos = str_replace("^", "'", $objetivos);
			$objetivos = str_replace("\"", "'", $objetivos);
			$objetivos = str_replace("\\", "/", $objetivos);

			$plan = $this->input->post('diag-plan', FALSE);
			$plan = str_replace("|", "/", $plan);
			$plan = str_replace("^", "'", $plan);
			$plan = str_replace("\"", "'", $plan);
			$plan = str_replace("\\", "/", $plan);

			$turno = $this->input->post('diag-turno');
			$ingreso = $this->input->post('diag-ingreso');
			$hc = $this->input->post('diag-hc');
			$id = $this->input->post('diag-id');

			$datos = $this->agenda->grabarDiagnostico($tipo, $motivo, $diagnostico, $plan, $turno, $ingreso, $hc, $id, $objetivos);

			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($datos));
		}
	}

	public function grabarEnfermeria()
	{
		$this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
		$this->form_validation->set_rules('diag-evolucion', 'evolucion', 'trim|required');
		$this->form_validation->set_message('required', 'Campo <strong>%s</strong> es obligatorio');

		if (!$this->form_validation->run()) {
			$datos['errores'] = validation_errors();

			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($datos));
		} else {

			$evolucion = $this->input->post('diag-evolucion', FALSE);
			$evolucion = str_replace("|", "/", $evolucion);
			$evolucion = str_replace("^", "'", $evolucion);
			$evolucion = str_replace("\"", "'", $evolucion);
			$evolucion = str_replace("\\", "/", $evolucion);
			$evolucion = str_replace("\n", "|", $evolucion);
			$evolucion = strtoupper($evolucion);

			$turno = $this->input->post('diag-turno');
			$ingreso = $this->input->post('diag-ingreso');
			$hc = $this->input->post('diag-hc');

			$datos = $this->agenda->grabarEnfermeria($hc, $turno, $ingreso, $evolucion);

			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($datos));
		}
	}

	public function grabarProblema()
	{
		$this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
		$this->form_validation->set_rules('fecha', 'fecha', 'trim|required');
		$this->form_validation->set_rules('texto', 'diagnostico', 'trim|required');

		$this->form_validation->set_message('required', 'Campo <strong>%s</strong> es obligatorio');

		if (!$this->form_validation->run()) {
			$errores = validation_errors();

			$datos['errores'] = $errores;

			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($datos));
		} else {

			$fecha = $this->input->post('fecha');
			$texto =  urldecode($this->input->post('texto'));

			$texto = str_replace("|", "/", $texto);
			$texto = str_replace("^", "'", $texto);
			$texto = str_replace("\"", "'", $texto);
			$texto = str_replace("\\", "/", $texto);

			$hc = $this->input->post('hc');
			$estado = $this->input->post('estado');
			$id = $this->input->post('id');

			$datos = $this->agenda->grabarProblema($fecha, $texto, $estado, $hc, $id);

			if (isset($datos->errores)) {
				$datos->errores = '<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $datos->errores . '</div>';
			}
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($datos));
		}
	}

	public function getAdjuntos($hc)
	{
		$arr = null;

		// "./uploads/"
		$map = directory_map(RUTA_ADJUNTOS . $hc);

		if (is_array($map)) {
			foreach ($map as $key => $valor) {
				$path = RUTA_ADJUNTOS . $hc . "\\" . $valor;
				$datos = get_file_info($path, 'date');
				$arr[$key] = array(
					'archivo' => $valor,
					'fecha' => date("Y-m-d", $datos['date']),
					'path' => $path,
				);
			}

			if (isset($arr)) {
				usort($arr, array($this, 'compararFechas'));
			}
		}

		return $arr;
	}

	public function getEstudios($hc)
	{
		$arr = null;

		// "./uploads/"
		$map = directory_map(RUTA_ESTUDIO . $hc);

		if (is_array($map)) {
			foreach ($map as $key => $valor) {
				$path = RUTA_ESTUDIO . $hc . "\\" . $valor;
				$datos = get_file_info($path, 'date');
				$arr[$key] = array(
					'archivo' => $valor,
					'fecha' => date("Y-m-d", $datos['date']),
					'path' => $path,
				);
			}

			if (isset($arr)) {
				usort($arr, array($this, 'compararFechas'));
			}
		}

		return $arr;
	}


	public function getArchivos($hc)
	{
		$arr = null;

		$map = directory_map(RUTA_HC . $hc);

		if (is_array($map)) {
			foreach ($map as $key => $valor) {
				$datos = get_file_info(RUTA_HC . $hc . "\\" . $valor, 'date');
				$arr[$key] = array('archivo' => $valor, 'fecha' => date("Y-m-d", $datos['date']));
			}

			if (isset($arr)) {
				usort($arr, array($this, 'compararFechas'));
			}
		}
		return $arr;
	}

	private function compararFechas($a, $b)
	{
		return strnatcmp($b['fecha'], $a['fecha']);
	}

	public function getArchivo($hc, $archivo)
	{
		$archivo = str_replace("%20", " ", $archivo);
		$archivo = RUTA_HC . $hc . "\\" . $archivo; /*urlencode*/

		$contenido = file_get_contents($archivo) or die('error al abrir archivo');
		header("Content-Type: application/pdf");

		echo $contenido;
	}

	public function getArchivoAdjunto($hc, $archivo)
	{
		$archivo = str_replace("%20", " ", $archivo);
		$archivo = RUTA_ADJUNTOS . $hc . "\\" . $archivo; /*urlencode*/

		$contenido = file_get_contents($archivo) or die('error al abrir archivo');
		header("Content-Type: application/pdf");

		echo $contenido;
	}

	public function getArchivoEstudio($hc, $archivo)
	{
		$archivo = str_replace("%20", " ", $archivo);
		$archivo = RUTA_ESTUDIO . $hc . "\\" . $archivo; /*urlencode*/

		$contenido = file_get_contents($archivo) or die('error al abrir archivo');
		header("Content-Type: application/pdf");

		echo $contenido;
	}

	public function PDF()
	{
		$hc = $_POST['hc'];
		$archivo = $_POST['archivo'];

		$data = array(
			'contenido' => base_url('agenda/getArchivo/' . $hc . '/' . $archivo),
			'url' => base_url('agenda/descargarArchivo/' . $hc . '/' . $archivo)
		);

		$this->load->view('inc/PDF', $data);
	}

	public function PDFadjunto()
	{
		$hc = $_POST['hc'];
		$archivo = $_POST['archivo'];

		$data = array(
			'contenido' => base_url('agenda/getArchivoAdjunto/' . $hc . '/' . $archivo),
			'url' => base_url('agenda/descargarArchivoAdjunto/' . $hc . '/' . $archivo)
		);

		$this->load->view('inc/PDF', $data);
	}

	public function getArchivoPDF()
	{
		$archivo = $_GET["path"];
		$contenido = file_get_contents($archivo) or die('error al abrir archivo');
		header("Content-Type: application/pdf");

		echo $contenido;
	}

	public function descargarArchivoPDF()
	{
		$archivo = $_GET["path"];
		force_download($archivo, NULL);
	}

	public function PDFwithpath()
	{
		$archivo = $_POST['archivo'];

		$data = array(
			'contenido' => base_url('agenda/getArchivoPDF/?path=' . $archivo),
			'url' => base_url('agenda/descargarArchivoPDF/?path=' . $archivo)
		);

		$this->load->view('inc/PDF', $data);
	}

	public function PDFestudio()
	{
		$hc = $_POST['hc'];
		$archivo = $_POST['archivo'];

		$data = array(
			'contenido' => base_url('agenda/getArchivoEstudio/' . $hc . '/' . $archivo),
			'url' => base_url('agenda/descargarArchivoEstudio/' . $hc . '/' . $archivo)
		);

		$this->load->view('inc/PDF', $data);
	}

	public function descargarArchivo($hc, $archivo)
	{
		$archivo = RUTA_HC . $hc . "\\" . $archivo;
		force_download($archivo, NULL);
	}

	public function descargarArchivoAdjunto($hc, $archivo)
	{
		$archivo = RUTA_ADJUNTOS . $hc . "\\" . $archivo;
		force_download($archivo, NULL);
	}

	public function descargarArchivoEstudio($hc, $archivo)
	{
		$archivo = RUTA_ESTUDIO . $hc . "\\" . $archivo;
		force_download($archivo, NULL);
	}

	public function do_upload()
	{

		// Detect form submission.
		$tipo = $this->input->post('tipo-estudio');
		$hc = $this->input->post('hc-adjuntos');
		$saf = $this->input->post('ingreso-adjuntos');
		$afiliado = $this->input->post('afiliado-adjuntos');
		$entidad = $this->input->post('entidad-adjuntos');

		$nombre = $tipo;

		//'./uploads/'
		if (!is_dir(RUTA_ADJUNTOS . $hc)) {
			mkdir(RUTA_ADJUNTOS . $hc, 0777, TRUE);
		}

		$path = RUTA_ADJUNTOS . $hc;
		$this->load->library('upload');

		/**
		 * Refer to https://ellislab.com/codeigniter/user-guide/libraries/file_uploading.html
		 * for full argument documentation.
		 *
		 */

		// Define file rules
		$this->upload->initialize(array(
			"upload_path"       =>  $path,
			"allowed_types"     =>  "pdf|jpg|png|doc|jpeg|docx|xls|xlsx",
			"max_size"          =>  '20480',
			"file_name"			=>	array($nombre)
		));
		$html = "";

		if ($this->upload->do_multi_upload("files")) {
			$archivos = $this->upload->get_multi_upload_data();
			foreach ($archivos as $k => $archivo) {
				$this->agenda->grabarAdjunto($hc, $saf, $this->session->userdata('matricula'), "", $path . "\\" . $archivo['file_name'], $afiliado, $entidad);
				$html .= '<li class="alert alert-success"><span class="badge badge-success pull-right">Subido</span>' . $archivo['file_name'] . '</li>';
			}
		} else {
			// Output the errors
			$errors = array('error' => $this->upload->display_errors('<li class="alert alert-error"><span class="badge badge-error pull-right">Error</span>', '</li>'));
			foreach ($errors as $k => $error) {
				$html .= $error;
			}
		}

		echo $html;

		exit();
	}

	public function llamarPaciente()
	{
		$comp = $_POST['comp'];
		$mat = $this->session->userdata('matricula');
		$box = $this->session->userdata('consul');
		$serv = $this->session->userdata('id_servicio');
		$ofi = $this->session->userdata('oficina');

		echo $this->agenda->llamarPac($comp, $mat, $box, $serv, $ofi);
	}

	public function noLlamarPaciente()
	{
		$comp = $_POST['comp'];
		$mat = $this->session->userdata('matricula');
		$box = $this->session->userdata('consul');
		$serv = $this->session->userdata('id_servicio');
		$ofi = $this->session->userdata('oficina');

		echo $this->agenda->noLlamarPac($comp, $mat, $box, $serv, $ofi);
	}

	public function getParteQ()
	{
		//FIXME: Anulado porque nunca se importo la libreria y no hay registros de que se use o se haya solicitado. 20200408
		return;
		
		/*
		//! Copia modificada de laslomas.com.ar/honorarios
		$id = $this->input->get('id');
		$hc = $this->input->get('hc');

		if ($id == "" || $hc == "") die("No se obtuvieron los datos.");

		try {
			$data = $this->agenda->getParte($hc, $id);
			$data["pac"] =  $this->agenda->getDatosPac($hc);

			//https://mpdf.github.io/reference/mpdf-functions/mpdf.html
			require_once(APPPATH . 'libraries/mpdf60/mpdf.php');

			//([ string $mode [, mixed $format [, float $default_font_size [, string $default_font 
			//[, float $margin_left , float $margin_right , float $margin_top , float $margin_bottom , float $margin_header , float $margin_footer [, string $orientation ]]]]]])
			$mpdf = new mPDF('utf-8', 'Letter');
			$html = $this->load->view('agenda/htmlPQ', $data, true);
			$html = utf8_encode($html);
			$pdfFilePath = $id . "_" . $hc . "_" . date("d/m/Y") . ".pdf";
			$mpdf->WriteHTML($html);

			$prof = explode("^", $data["profesional"]);
			$mpdf->Image('//10.11.1.27/firmas/' . $prof[0] . '.jpg', 88, 218, 40, 30, 'jpg', '', true, false);
			$mpdf->Image(base_url('assets/img/SLL.png'), 18, 18, 10, 10, 'jpg', '', true, false);
			$mpdf->Output($pdfFilePath, "D");

			// DEBUG
			//$this->load->view('agenda/htmlPQ', $data);	
		} catch (Exception $e) {
			die('Se produjo un error al procesar los datos: ' . $e->getMessage());
		}
		
		*/
	}
}
