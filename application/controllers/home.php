<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function index()
	{
		$data = array('title' => 'Inicio');
		$this->load->view('/layout/head', $data);
		//$this->load->view('/layout/disenio_css_js');
		//$this->load->view('/layout/menu_proyecto');
		//$this->load->view('/layout/menu_bootstrap');
		$this->load->view('/layout/css_js_inicio');
		$this->load->view('/layout/header');
		$this->load->view('/layout/nav');
		$this->load->view('/home/content');
		$this->load->view('/layout/footer');
	}
}
