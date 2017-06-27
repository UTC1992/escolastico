<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultar_Notas_Controller extends CI_Controller 
{
	public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_estu')) {
			header('Location:' . base_url() . 'login_estu/index');
		}
		$data = array('title' => 'Califícaciones');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/consultas_estudiante/index');
		$this->load->view('/layout/footer_base');
	}

	public function repoParcial() {
		$this->load->view('/layout/menuAdmin');
		$cedula = $this->session->userdata('cedula');
		$idEstu = $this->session->userdata('id_estu');
		$data = array('cedula' => $cedula, 'idEstu' => $idEstu);
		$this->load->view('/consultas_estudiante/porparcial', $data);
	}

	public function repoQuimestral() {
		$this->load->view('/layout/menuAdmin');
		$cedula = $this->session->userdata('cedula');
		$idEstu = $this->session->userdata('id_estu');
		$data = array('cedula' => $cedula, 'idEstu' => $idEstu);
		$this->load->view('/consultas_estudiante/porquimestre', $data);
	}

	public function repoAnual() {
		$this->load->view('/consultas_estudiante/poranio');
	}

	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonMatricula()
	{
		$json = new Services_JSON();

		$datos = array();

		$datosMatri = $this->input->post();
		$fila = $this->consultar_notas_model->getMatricula($datosMatri);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosP = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosP;
	}
}
