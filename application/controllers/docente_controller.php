<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docente_Controller extends CI_Controller 
{
	public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$data = array('title' => 'Docente');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/docente/index');
		$this->load->view('/layout/footer_base');
	}

	public function listar()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$this->load->view('/docente/listar');
	}

	public function getDataJsonDocenteAll()
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->docente_model->getDocente();
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		
		//convertimos en datos json nuestros datos
		$docente = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $docente;
	}

	public function insertar()
	{	
		//se optiene los datos mediante el metodo POST
		$docente = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->docente_model->insertD($docente);
	}

	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonDocenteId($id = "")
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->docente_model->getById($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosP = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosP;
	}

	public function actualizar($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$docenteEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->docente_model->updateD($docenteEdit, $id);
		
	}

	public function actualizarClave($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$docenteEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->docente_model->updateClave($docenteEdit, $id);
		
	}
}
