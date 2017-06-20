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
		$cedula = $this->session->userdata('cedula');
		$idEstu = $this->session->userdata('id_estu');
		$data = array('cedula' => $cedula, 'idEstu' => $idEstu);
		$this->load->view('/consultas_estudiante/porparcial', $data);
	}

	public function repoQuimestral() {
		$this->load->view('/consultas_estudiante/porquimestre');
	}

	public function repoAnual() {
		$this->load->view('/consultas_estudiante/poranio');
	}
}
