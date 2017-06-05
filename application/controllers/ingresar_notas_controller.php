<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingresar_Notas_Controller extends CI_Controller 
{
	public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_doce')) {
			header('Location:' . base_url() . 'notas_/ingresar_notas/login');
		}
		
		$data = array('title' => 'Ingreso de Notas');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/menuIngresoNotas');
		$this->load->view('/ingreso_notas/content');
		$this->load->view('/layout/footer_ingresoNotas');
	}

	public function ingresoNotas()
	{
		$this->load->view('/ingreso_notas/ingresoNotas');
	}

	public function informesNotas()
	{
		$this->load->view('/ingreso_notas/informes');
	}
}
