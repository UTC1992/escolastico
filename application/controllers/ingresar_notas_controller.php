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

	public function inicioNotas()
	{
		$this->load->view('/ingreso_notas/inicioNotas');
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

	public function ingresoExaMejora()
	{
		$this->load->view('/ingreso_notas/ingresarExaMejora');
	}

	public function consultaExaMejora()
	{
		$this->load->view('/ingreso_notas/consultarExaMejora');
	}

	public function ingresoExaRemedial()
	{
		$this->load->view('/ingreso_notas/ingresarExaRemedial');
	}

	public function consultaExaRemedial()
	{
		$this->load->view('/ingreso_notas/consultarExaRemedial');
	}

	public function ingresoExaGracia()
	{
		$this->load->view('/ingreso_notas/ingresarExaGracia');
	}

	public function consultaExaGracia()
	{
		$this->load->view('/ingreso_notas/consultarExaGracia');
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
		$fila = $this->Ingresar_Notas_Model->getEstudiantesMatriculados($matricula);
		
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
		$bool = $this->Ingresar_Notas_Model->insertN1($notas);
	}

	public function insertar2()
	{	
		//se optiene los datos mediante el metodo POST
		$notas = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Ingresar_Notas_Model->insertN2($notas);
	}

	public function insertar3()
	{	
		//se optiene los datos mediante el metodo POST
		$notas = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Ingresar_Notas_Model->insertN3($notas);
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
		$fila = $this->Ingresar_Notas_Model->getInformeP1($matricula);
		
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
		$fila = $this->Ingresar_Notas_Model->getInformeP2($matricula);
		
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
		$fila = $this->Ingresar_Notas_Model->getInformeP3($matricula);
		
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
		$fila = $this->Ingresar_Notas_Model->getContar1($matricula);
		
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
		$fila = $this->Ingresar_Notas_Model->getContar2($matricula);
		
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
		$fila = $this->Ingresar_Notas_Model->getContar3($matricula);
		
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

		$fila = $this->Ingresar_Notas_Model->getNotasEdit1($id);
		
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

		$fila = $this->Ingresar_Notas_Model->getNotasEdit2($id);
		
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

		$fila = $this->Ingresar_Notas_Model->getNotasEdit3($id);
		
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
		$bool = $this->Ingresar_Notas_Model->updateP1($notasEdit, $id);
		
	}

	public function actualizar2($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$notasEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Ingresar_Notas_Model->updateP2($notasEdit, $id);
		
	}

	public function actualizar3($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$notasEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Ingresar_Notas_Model->updateP3($notasEdit, $id);
		
	}

	/*===============================EXAMENES======================================*/
	public function getDataJsonContarExa1()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->Ingresar_Notas_Model->getContarExa1($matricula);
		
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
		$bool = $this->Ingresar_Notas_Model->insertExa($notas);
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
		$fila = $this->Ingresar_Notas_Model->getExamenes($matricula);
		
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

		$fila = $this->Ingresar_Notas_Model->getNotasExaEdit($id);
		
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
		$bool = $this->Ingresar_Notas_Model->updateExa($notasEdit, $id);
		
	}

	/*===============================EXAMENES SUPLETORIOS=============================================*/

	public function getDataJsonConsultaNotasTotales()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->Ingresar_Notas_Model->getNotasTotales($matricula);
		
		//$fila = $this->Ingresar_Notas_Model->getNotasTotales();

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
		$fila = $this->Ingresar_Notas_Model->getContarExaSuple($matricula);
		
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
		$bool = $this->Ingresar_Notas_Model->insertExaSuple($notas);
	}

	public function getDataJsonConsultaNotasTotalesSupletorio()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->Ingresar_Notas_Model->getNotasTotalesSupletorio($matricula);
		
		//$fila = $this->Ingresar_Notas_Model->getNotasTotales();

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

		$fila = $this->Ingresar_Notas_Model->getNotasSupleEdit($id);
		
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
		$bool = $this->Ingresar_Notas_Model->updateSuple($notasEdit, $id);
		
	}

	public function getDataJsonConsultaNotaMejoraId()
	{
		$json = new Services_JSON();
		$datos = array();

		//se optiene los datos mediante el metodo POST
		$dato = $this->input->post();
		$fila = $this->Ingresar_Notas_Model->getNotasMejoraId($dato);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

/*===============================EXAMENES MEJORA=============================================*/
	
	public function getDataJsonContarExaMejora()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->Ingresar_Notas_Model->getContarExaMejora($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function insertarExaMejora()
	{	
		//se optiene los datos mediante el metodo POST
		$notas = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Ingresar_Notas_Model->insertExaMejora($notas);
	}

	public function getDataJsonConsultaNotasTotalesMejora()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->Ingresar_Notas_Model->getNotasTotalesMejora($matricula);
		
		//$fila = $this->Ingresar_Notas_Model->getNotasTotales();

		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}
	
	public function getDataJsonNotasEditMejora($id = '')
	{
		$json = new Services_JSON();
		$datos = array();

		$fila = $this->Ingresar_Notas_Model->getNotasMejoraEdit($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}
	
	public function actualizarMejora($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$notasEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Ingresar_Notas_Model->updateMejora($notasEdit, $id);
		
	}

/*======================================EXAMEN REMEDIAL==============================================*/

	public function getDataJsonContarExaRemedial()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->Ingresar_Notas_Model->getContarExaRemedial($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}
	
	public function insertarExaRemedial()
	{	
		//se optiene los datos mediante el metodo POST
		$notas = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Ingresar_Notas_Model->insertExaRemedial($notas);
	}
	
	public function getDataJsonConsultaNotasTotalesRemedial()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->Ingresar_Notas_Model->getNotasTotalesRemedial($matricula);
		
		//$fila = $this->Ingresar_Notas_Model->getNotasTotales();

		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}
	
	public function getDataJsonNotasEditRemedial($id = '')
	{
		$json = new Services_JSON();
		$datos = array();

		$fila = $this->Ingresar_Notas_Model->getNotasRemedialEdit($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}
	
	public function actualizarRemedial($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$notasEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Ingresar_Notas_Model->updateRemedial($notasEdit, $id);
		
	}

/*======================================EXAMEN GRACIA==============================================*/

	public function getDataJsonContarExaGracia()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->Ingresar_Notas_Model->getContarExaGracia($matricula);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}

	public function insertarExaGracia()
	{	
		//se optiene los datos mediante el metodo POST
		$notas = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Ingresar_Notas_Model->insertExaGracia($notas);
	}
	
	public function getDataJsonConsultaNotasTotalesGracia()
	{
		$json = new Services_JSON();
		$datos = array();
		//se optiene los datos mediante el metodo POST
		$matricula = $this->input->post();
		$fila = $this->Ingresar_Notas_Model->getNotasTotalesGracia($matricula);
		
		//$fila = $this->Ingresar_Notas_Model->getNotasTotales();

		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}
	
	public function getDataJsonNotasEditGracia($id = '')
	{
		$json = new Services_JSON();
		$datos = array();

		$fila = $this->Ingresar_Notas_Model->getNotasGraciaEdit($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosE = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosE;
	}
	
	public function actualizarGracia($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$notasEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Ingresar_Notas_Model->updateGracia($notasEdit, $id);
		
	}

}
