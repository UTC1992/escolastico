<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_Controller extends CI_Controller 
{
	public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$data = array('title' => 'Curso');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/curso/index');
		$this->load->view('/layout/footer_base');
	}

    public function listar()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$this->load->view('/curso/listar');
	}

	/**
	* obtener los datos en formato json
	*/
	public function getDataJsonCursoAll()
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->curso_model->getCurso();
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		
		//convertimos en datos json nuestros datos
		$asignatura = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $asignatura;
	}

	public function insertar()
	{	
		//se optiene los datos mediante el metodo POST
		$curso = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->curso_model->insertC($curso);
	}

	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonCursoId($id = "")
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->curso_model->getById($id);
		
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
		$cursoEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->curso_model->updateC($cursoEdit, $id);
		
	}

	public function getDataJsonCursoNivel()
	{
		$json = new Services_JSON();

		$datos = array();

		$datosNivel = $this->input->post();
		$fila = $this->curso_model->getCursoNivel($datosNivel);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosP = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosP;
	}

	public function getDataJsonNombreCurso()
	{
		$json = new Services_JSON();

		$datos = array();

		$nombreCurso = $this->input->post();
		$fila = $this->curso_model->getCursoNombre($nombreCurso);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosP = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosP;
	}

}
