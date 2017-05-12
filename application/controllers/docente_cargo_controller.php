<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docente_Cargo_Controller extends CI_Controller 
{
    public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$data = array('title' => 'Docente y sus Cargos');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/docente_cargo/index');
		$this->load->view('/layout/footer_base');
	}

    public function listar()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$this->load->view('/docente_cargo/listar');
	}
}