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

	/**
	* obtener los datos en formato json
	*/
	public function getDataJsonDocenteCargoAll()
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->Docente_Cargo_Model->getDocenteCargo();
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		
		//convertimos en datos json nuestros datos
		$datosDC = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosDC;
	}

	public function getDataJsonDocenteCargo()
	{
		$json = new Services_JSON();

		$datos = array();

		//obtener datos enviador por metodo post
		$docenteCargo = $this->input->post();
		//declarcion de variables para la consultas
		$idCurso = $docenteCargo['id_curs'];
		$idDoce = $docenteCargo['id_doce'];
		$idAsig = $docenteCargo['id_asig'];
		$idCargo = $docenteCargo['id_cargo'];

		$fila = $this->Docente_Cargo_Model->getDocenteCargoListar($idCurso, $idDoce, $idAsig, $idCargo);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		
		//convertimos en datos json nuestros datos
		$datosDC = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosDC;
	}

	public function insertar()
	{	
		//se optiene los datos mediante el metodo POST
		$docenteC = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Docente_Cargo_Model->insertDC($docenteC);
	}

	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonDocenteCargoId($id = "")
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->Docente_Cargo_Model->getById($id);
		
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
		$docenteCargo = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Docente_Cargo_Model->updateDC($docenteCargo, $id);
		
	}

	/////////////////////
	
	public function getDataJsonCargoDocente()
	{
		$json = new Services_JSON();

		$datos = array();

		$docente = $this->input->post();
		$fila = $this->Docente_Cargo_Model->getDatosCargo($docente);
		
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
