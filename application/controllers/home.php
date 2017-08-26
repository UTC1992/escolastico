<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function index()
	{
		$data = array('title' => 'Inicio');
		$this->load->view('/layout/head', $data);
		$this->load->view('/home/nav_carrucel');
		$this->load->view('/home/content');
		$this->load->view('/layout/footer');
		
	}

	public function misionVision()
	{
		$data = array('title' => 'Misión y Visión');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/menuIngresoNotas');
		$this->load->view('/home/misionyVision');
		$this->load->view('/layout/footer');
		
	}
}
