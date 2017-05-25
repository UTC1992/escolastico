<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matricula_Controller extends CI_Controller 
{
    public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$data = array('title' => 'Matricular');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/matricula/index');
		$this->load->view('/layout/footer_base');
	}

    public function registrar()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$this->load->view('/matricula/registro');
	}
}