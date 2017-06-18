<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_Matriculas_Controller extends CI_Controller 
{
	public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$data = array('title' => 'Reportes Matrículas');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/reporte_matriculas/index');
		$this->load->view('/layout/footer_base');
	}

	public function porCurso()
	{
		$this->load->view('/reporte_matriculas/porcurso');
	}

	public function porParalelo()
	{
		$this->load->view('/reporte_matriculas/porparalelo');
	}

	public function porCP()
	{
		$this->load->view('/reporte_matriculas/porcp');
	}

	public function getDataJsonEstudiantesReporte()
	{
		$json = new Services_JSON();

		$datos = array();

		$datosNivel = $this->input->post();
		$fila = $this->reporte_matriculas_model->getReporteMatriPorCurso($datosNivel);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}
}
