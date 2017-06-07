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

	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonEstudiantesMatriculados()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->ingresar_notas_model->getEstudiantesMatriculados($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function insertar1()
	{	
		//se optiene los datos mediante el metodo POST
		$notas = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->ingresar_notas_model->insertN1($notas);
	}

	public function insertar2()
	{	
		//se optiene los datos mediante el metodo POST
		$notas = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->ingresar_notas_model->insertN2($notas);
	}

	public function insertar3()
	{	
		//se optiene los datos mediante el metodo POST
		$notas = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->ingresar_notas_model->insertN3($notas);
	}

	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonInformesParcial1()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->ingresar_notas_model->getInformeP1($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonInformesParcial2()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->ingresar_notas_model->getInformeP2($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonInformesParcial3()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->ingresar_notas_model->getInformeP3($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}
}
