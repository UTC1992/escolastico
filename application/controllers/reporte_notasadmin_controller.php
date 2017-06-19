<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_Notasadmin_Controller extends CI_Controller 
{
	public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$data = array('title' => 'Reportes Notas');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/reporte_notasAdmin/index');
		$this->load->view('/layout/footer_base');
	}

	public function repoParcial() {
		$this->load->view('/reporte_notasAdmin/porparcial');
	}

	public function repoQuimestral() {
		$this->load->view('/reporte_notasAdmin/porquimestre');
	}

	public function repoAnual() {
		$this->load->view('/reporte_notasAdmin/poranio');
	}

	public function getDataJsonNotasParcial1()
	{
		$json = new Services_JSON();

		$datos = array();

		$datosNotas = $this->input->post();
		$fila = $this->reporte_notasadmin_model->getRepoNotasParcial1($datosNotas);
		
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
