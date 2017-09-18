<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_Asignatura_Controller extends CI_Controller 
{
	public function insertar()
	{	
		//se optiene los datos mediante el metodo POST
		$asignaturaCurso = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Curso_Asignatura_Model->insertAC($asignaturaCurso);
	}

	/**
	* obtener los datos en formato json
	*/
	public function getDataJsonAsigCurso($id = "")
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->Curso_Asignatura_Model->getAsignaturasByCurso($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		
		//convertimos en datos json nuestros datos
		$asignaturaCurso = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $asignaturaCurso;
	}

	/**
	* eliminar un campo
	*/
	public function eliminar($id = "")
	{
		$bool = $this->Curso_Asignatura_Model->deleteAC($id);
	}

}
