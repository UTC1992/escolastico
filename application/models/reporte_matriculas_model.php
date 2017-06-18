<?php
	
	/**
	* 
	*/
	class Reporte_Matriculas_Model extends CI_Model
	{
		public function getReporteMatriPorCurso($datosNivel = null)
		{
			$anioI = $datosNivel['fechainicio_matr'];
			$anioF = $datosNivel['fechafin_matr'];
			$idCurso = $datosNivel['id_curs'];

			$result = $this->db->query("SELECT *
										FROM estudiante, matricula
										WHERE matricula.id_estu = estudiante.id_estu
										AND matricula.id_curs = '" . $idCurso . "'
										AND matricula.fechainicio_matr LIKE '" . $anioI . "%'
										AND matricula.fechafin_matr LIKE '" . $anioF . "%'
										;");
			//return $result->row();
			return $result;
		}

		public function getReporteMatriPorCP($datosNivel = null)
		{
			$anioI = $datosNivel['fechainicio_matr'];
			$anioF = $datosNivel['fechafin_matr'];
			$idCurso = $datosNivel['id_curs'];
			$paralelo = $datosNivel['paralelo_matr'];

			$result = $this->db->query("SELECT *
										FROM estudiante, matricula
										WHERE matricula.id_estu = estudiante.id_estu
										AND matricula.id_curs = '" . $idCurso . "'
										AND matricula.fechainicio_matr LIKE '" . $anioI . "%'
										AND matricula.fechafin_matr LIKE '" . $anioF . "%'
										AND matricula.paralelo_matr = '" . $paralelo . "'
										;");
			//return $result->row();
			return $result;
		}
	}
