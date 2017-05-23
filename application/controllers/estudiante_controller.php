<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante_Controller extends CI_Controller 
{
	public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$data = array('title' => 'Estudiantes');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/estudiante/index');
		$this->load->view('/layout/footer_base');
	}

    public function listar()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$this->load->view('/estudiante/listar');
	}

    public function getDataJsonEstudiantesAll()
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->estudiante_model->getEstudiante();
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function insertar()
	{	
		//se optiene los datos mediante el metodo POST
		$estudiante = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->estudiante_model->insertE($estudiante);
	}
	
	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonEstudianteId($id = "")
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->estudiante_model->getById($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function actualizar($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$estudianteEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->estudiante_model->updateE($estudianteEdit, $id);
		
	}
}