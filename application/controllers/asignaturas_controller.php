<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignaturas_Controller extends CI_Controller 
{
	public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$data = array('title' => 'Asignatura');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/disenio_css_js');
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/asignatura/index');
		$this->load->view('/layout/footer');
	}

    public function listar()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$this->load->view('/asignatura/listar');
	}
}

