<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodoa_Controller extends CI_Controller 
{
	public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$data = array('title' => 'Periodo Académico');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/css_js_inicio');
		$this->load->view('/layout/header_admin');
		$this->load->view('/layout/nav_admin');
        $result = $this->periodoa_model->getPeriodoAcademico();
        $data = array('consulta' => $result );
		$this->load->view('/periodo_academico/content', $data);
        $this->load->view('/layout/footer');
        //$this->load->view('/layout/footer_table_dinamic');
	}
}