<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matricula_Controller extends CI_Controller 
{
    public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$data = array('title' => 'Matricular');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/matricula/index');
		$this->load->view('/layout/footer_base');
	}

    public function registrar()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$this->load->view('/matricula/registro');
	}

	/**
	* obtener los datos en formato json
	*/
	public function getDataJsonEstudiante($cedula = "")
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->matricula_model->getEstudiante($cedula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		
		//convertimos en datos json nuestros datos
		$data = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $data;
	}

	public function insertar()
	{	
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->matricula_model->insertM($matricula);
	}

	/**
	* obtener los datos en formato json
	*/
	public function getDataJsonCertificado($cedula = "", $AI = "", $AF = "")
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->matricula_model->getCertificado($cedula, $AI, $AF);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		
		//convertimos en datos json nuestros datos
		$data = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $data;
	}
	
	/**
	* obtener los datos en formato json
	*/
	public function getDataJsonCertiImprimir($idEstu = "", $fechaI = "", $fechaF = "")
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->matricula_model->getCertificadoImprimir($idEstu, $fechaI, $fechaF);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		
		//convertimos en datos json nuestros datos
		$data = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $data;
	}

}