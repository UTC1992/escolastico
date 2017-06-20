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

			$result = $this->db->query("SELECT 	asignatura_p1 as 'asignatura', parametro1_p1 as 'p1', 
												parametro2_p1 as 'p2', parametro3_p1 as 'p3', parametro4_p1 as 'p4',
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

		public function getRepoNotasParcial2($datos = null)
		{
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];
			$idCurso = $datos['idCurso'];
			$paralelo = $datos['paralelo'];
			$quimestre = $datos['quimestre'];
			$idEstu = $datos['idEstu'];

			$result = $this->db->query("SELECT 	asignatura_p2 as 'asignatura', parametro1_p2 as 'p1', 
												parametro2_p2 as 'p2', parametro3_p2 as 'p3', parametro4_p2 as 'p4',
												ROUND(((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2)/4), 2) as 'Promedio'
										FROM estudiante, matricula, parcial_2
										WHERE 
											matricula.fechainicio_matr LIKE '" . $anioI . "%'
										AND matricula.fechafin_matr LIKE '" . $anioF . "%'
										AND matricula.id_curs = '" . $idCurso . "'
										AND matricula.paralelo_matr = '" . $paralelo . "'
										AND parcial_2.anioInicio_p2 = '" . $anioI . "'
										AND parcial_2.anioFin_p2 = '" . $anioF . "'
										AND parcial_2.quimestre_p2 = '" . $quimestre . "'
										AND parcial_2.id_estu = '" . $idEstu . "'
										AND estudiante.id_estu = matricula.id_estu
										AND estudiante.id_estu = parcial_2.id_estu
										;");
			//return $result->row();
			return $result;
		}

		public function getRepoNotasParcial3($datos = null)
		{
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];
			$idCurso = $datos['idCurso'];
			$paralelo = $datos['paralelo'];
			$quimestre = $datos['quimestre'];
			$idEstu = $datos['idEstu'];

			$result = $this->db->query("SELECT 	asignatura_p3 as 'asignatura', parametro1_p3 as 'p1', parametro2_p3 as 'p2', 
												parametro3_p3 as 'p3', parametro4_p3 as 'p4',
												ROUND(((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3)/4), 2) as 'Promedio'
										FROM estudiante, matricula, parcial_3
										WHERE 
											matricula.fechainicio_matr LIKE '" . $anioI . "%'
										AND matricula.fechafin_matr LIKE '" . $anioF . "%'
										AND matricula.id_curs = '" . $idCurso . "'
										AND matricula.paralelo_matr = '" . $paralelo . "'
										AND parcial_3.anioInicio_p3 = '" . $anioI . "'
										AND parcial_3.anioFin_p3 = '" . $anioF . "'
										AND parcial_3.quimestre_p3 = '" . $quimestre . "'
										AND parcial_3.id_estu = '" . $idEstu . "'
										AND estudiante.id_estu = matricula.id_estu
										AND estudiante.id_estu = parcial_3.id_estu
										;");
			//return $result->row();
			return $result;
		}

		public function getRepoNotasQuimestre1($datos = null)
		{
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];
			$idCurso = $datos['idCurso'];
			$paralelo = $datos['paralelo'];
			$quimestre = $datos['quimestre'];
			$idEstu = $datos['idEstu'];

			$result = $this->db->query("SELECT
												asignatura_p1 as 'asignatura',
												ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1) / 4 ), 2) as 'parcial1',
												ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2) / 4 ), 2) as 'parcial2',
												ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3) / 4 ), 2) as 'parcial3',
												nota_exa
										FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen
										WHERE estudiante.id_estu = '" . $idEstu . "'
										AND matricula.id_curs = '" . $idCurso . "'
										AND parcial_1.quimestre_p1 = '" . $quimestre . "'
										AND parcial_1.anioInicio_p1 = '" . $anioI . "'
										AND parcial_1.anioFin_p1 = '" . $anioF . "'
										AND parcial_2.quimestre_p2 = '" . $quimestre . "'
										AND parcial_2.anioInicio_p2 = '" . $anioI . "'
										AND parcial_2.anioFin_p2 = '" . $anioF . "'
										AND parcial_3.quimestre_p3 = '" . $quimestre . "'
										AND parcial_3.anioInicio_p3 = '" . $anioI . "'
										AND parcial_3.anioFin_p3 = '" . $anioF . "'
										AND parcial_1.asignatura_p1 = parcial_2.asignatura_p2
										AND parcial_1.asignatura_p1 = parcial_3.asignatura_p3
										AND parcial_2.asignatura_p2 = parcial_1.asignatura_p1
										AND parcial_2.asignatura_p2 = parcial_3.asignatura_p3
										AND parcial_3.asignatura_p3 = parcial_1.asignatura_p1
										and parcial_3.asignatura_p3 = parcial_2.asignatura_p2
										AND parcial_1.id_estu = estudiante.id_estu
										AND parcial_2.id_estu = estudiante.id_estu
										AND parcial_3.id_estu = estudiante.id_estu
										AND matricula.id_estu = estudiante.id_estu
										AND matricula.fechainicio_matr LIKE '" . $anioI . "%'
										AND matricula.fechafin_matr LIKE '" . $anioF . "%'
										AND matricula.paralelo_matr = '" . $paralelo . "'
										AND examen.id_estu = estudiante.id_estu
										AND examen.quimestre_exa = '" . $quimestre . "'
										AND examen.anioInicio_exa = '" . $anioI . "'
										AND examen.anioFin_exa = '" . $anioF . "'
										AND examen.asignatura_exa = parcial_1.asignatura_p1
										AND examen.asignatura_exa = parcial_2.asignatura_p2
										AND examen.asignatura_exa = parcial_3.asignatura_p3
										;");
			//return $result->row();
			return $result;
		}

	}


