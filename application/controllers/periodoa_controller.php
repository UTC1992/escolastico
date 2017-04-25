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

	public function nuevo()
    {
		//se comprueba que la sesion exista y se redirecciona 
		//si existe va a la parte administrativa
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/dashboard');
		}
        $data = array('title' => 'Registro Periodo Académico');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/css_js_inicio');
		$this->load->view('/layout/header_admin');
		$this->load->view('/periodo_academico/nuevo');
		$this->load->view('/layout/footer');
    }

	public function insertar()
	{
		//se optiene los datos mediante el metodo POST
		$periodo = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->periodoa_model->insertP($periodo);
		//se conprueba el registro correcto del registro
		if ($bool) {
			header("Location: " . base_url() . "admin_/periodoacademico");
		} else {
			header("Location: " . base_url() . "admin_/periodoacademico/nuevo");
		}
	}

	public function getDataJson($id = "")
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->periodoa_model->getById($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		return $json->encode($datos);
		

	}

	public function edit($id = '')
    {
		$fila = $this->periodoa_model->getById($id);

		//se comprueba que la sesion exista y se redirecciona 
		//si existe va a la parte administrativa
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/dashboard');
		}
        $data = array('title' => 'Registro Periodo Académico');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/css_js_inicio');
		$this->load->view('/layout/header_admin');

		$data = array( 	'id'		=> $fila->id_pera,
						'mesI'		=> $fila->mesinicio_pera, 
						'anioI' 	=> $fila->anioinicio_pera,
						'mesF'		=> $fila->mesfin_pera,
						'anioF'		=> $fila->aniofin_pera );
		$this->load->view('/periodo_academico/editar', $data);
		$this->load->view('/layout/footer');
    }

	public function actualizar($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$periodoEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->periodoa_model->updateP($periodoEdit, $id);
		//se conprueba el registro correcto del registro
		if ($bool) {
			header("Location: " . base_url() . "admin_/periodoacademico");
		} else {
			header("Location: " . base_url() . "admin_/periodoacademico/edit/" . $id);
		}
	}


}