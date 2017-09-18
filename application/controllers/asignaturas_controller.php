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
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/asignatura/index');
		$this->load->view('/layout/footer_base');
	}

    public function listar()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$result = $this->Asignatura_Model->getAsignaturas();
        $data = array('consulta' => $result );
		$this->load->view('/asignatura/listar', $data);
	}

	public function insertar()
	{	
		//se optiene los datos mediante el metodo POST
		$asignatura = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Asignatura_Model->insertA($asignatura);
	}

	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonAsignaturaId($id = "")
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->Asignatura_Model->getById($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosP = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosP;
	}


	/**
	* obtener los datos en formato json
	*/
	public function getDataJsonAsignaturaAll()
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->Asignatura_Model->getAsignaturas();
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		
		//convertimos en datos json nuestros datos
		$asignatura = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $asignatura;
	}

	public function actualizar($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$asigEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Asignatura_Model->updateA($asigEdit, $id);
		
	}

}

