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

	public function ingresoNotasExa()
	{
		$this->load->view('/ingreso_notas/ingresarNotasExa');
	}

	public function consultarExa()
	{
		$this->load->view('/ingreso_notas/consultasExa');
	}

	public function ingresoExaSuple()
	{
		$this->load->view('/ingreso_notas/ingresoExaSuple');
	}

	public function consultaExaSuple()
	{
		$this->load->view('/ingreso_notas/consultaExaSuple');
	}

	public function consultarInformeFinal()
	{
		
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

	public function getDataJsonContar1()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->ingresar_notas_model->getContar1($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function getDataJsonContar2()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->ingresar_notas_model->getContar2($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function getDataJsonContar3()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->ingresar_notas_model->getContar3($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function getDataJsonNotasEdit1($id = '')
	{
		$json = new Services_JSON();
		$datos = array();

		$fila = $this->ingresar_notas_model->getNotasEdit1($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function getDataJsonNotasEdit2($id = '')
	{
		$json = new Services_JSON();
		$datos = array();

		$fila = $this->ingresar_notas_model->getNotasEdit2($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function getDataJsonNotasEdit3($id = '')
	{
		$json = new Services_JSON();
		$datos = array();

		$fila = $this->ingresar_notas_model->getNotasEdit3($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function actualizar1($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$notasEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->ingresar_notas_model->updateP1($notasEdit, $id);
		
	}

	public function actualizar2($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$notasEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->ingresar_notas_model->updateP2($notasEdit, $id);
		
	}

	public function actualizar3($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$notasEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->ingresar_notas_model->updateP3($notasEdit, $id);
		
	}

	/*===============================EXAMENES======================================*/
	public function getDataJsonContarExa1()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->ingresar_notas_model->getContarExa1($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function insertarExa()
	{	
		//se optiene los datos mediante el metodo POST
		$notas = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->ingresar_notas_model->insertExa($notas);
	}

	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonConsultaExa()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->ingresar_notas_model->getExamenes($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function getDataJsonNotasEditExa($id = '')
	{
		$json = new Services_JSON();
		$datos = array();

		$fila = $this->ingresar_notas_model->getNotasExaEdit($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function actualizarExa($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$notasEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->ingresar_notas_model->updateExa($notasEdit, $id);
		
	}

	/*===============================EXAMENES SUPLETORIOS=============================================*/

	public function getDataJsonConsultaNotasTotales()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->ingresar_notas_model->getNotasTotales($matricula);
		
		//$fila = $this->ingresar_notas_model->getNotasTotales();

		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function getDataJsonContarExaSuple()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->ingresar_notas_model->getContarExaSuple($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function insertarExaSuple()
	{	
		//se optiene los datos mediante el metodo POST
		$notas = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->ingresar_notas_model->insertExaSuple($notas);
	}

	public function getDataJsonConsultaNotasTotalesSupletorio()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->ingresar_notas_model->getNotasTotalesSupletorio($matricula);
		
		//$fila = $this->ingresar_notas_model->getNotasTotales();

		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function getDataJsonNotasEditSuple($id = '')
	{
		$json = new Services_JSON();
		$datos = array();

		$fila = $this->ingresar_notas_model->getNotasSupleEdit($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function actualizarSuple($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$notasEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->ingresar_notas_model->updateSuple($notasEdit, $id);
		
	}

}
