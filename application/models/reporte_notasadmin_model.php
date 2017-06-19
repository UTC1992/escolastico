<?php
	
	/**
	* 
	*/
	class Reporte_Notasadmin_Model extends CI_Model
	{
		public function getRepoNotasParcial1($datos = null)
		{
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];
			$idCurso = $datos['idCurso'];
			$paralelo = $datos['paralelo'];
			$quimestre = $datos['quimestre'];
			$idEstu = $datos['idEstu'];

			$result = $this->db->query("SELECT 	asignatura_p1, parametro1_p1, parametro2_p1, parametro3_p1, parametro4_p1,
												ROUND(((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1)/4), 2) as 'Promedio'
										FROM estudiante, matricula, parcial_1
										WHERE 
											matricula.fechainicio_matr LIKE '" . $anioI . "%'
										AND matricula.fechafin_matr LIKE '" . $anioF . "%'
										AND matricula.id_curs = '" . $idCurso . "'
										AND matricula.paralelo_matr = '" . $paralelo . "'
										AND parcial_1.anioInicio_p1 = '" . $anioI . "'
										AND parcial_1.anioFin_p1 = '" . $anioF . "'
										AND parcial_1.quimestre_p1 = '" . $quimestre . "'
										AND parcial_1.id_estu = '" . $idEstu . "'
										AND estudiante.id_estu = matricula.id_estu
										AND estudiante.id_estu = parcial_1.id_estu
										;");
			//return $result->row();
			return $result;
		}
	}
