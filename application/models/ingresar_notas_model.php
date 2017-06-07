<?php
	
	/**
	* 
	*/
	class Ingresar_Notas_Model extends CI_Model
	{
		public function getEstudiantesMatriculados($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];

			$result = $this->db->query("SELECT 
												estudiante.id_estu,
												nombres_estu,
												apellidos_estu
										 FROM 
										 		estudiante, matricula 
										 WHERE 
										 		matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "' 
												AND matricula.fechainicio_matr LIKE '" . $anioI . "%' 
												AND matricula.fechafin_matr LIKE '" . $anioF . "%' 
												AND matricula.id_estu = estudiante.id_estu
										;");
			//return $result->row();
			return $result;
		}

		public function insertN1($notas = null)
		{
			if ($notas != null) {
				$data = array(
					'parametro1_p1' 					=> $notas['parametro1'],
					'parametro2_p1' 					=> $notas['parametro2'],
					'parametro3_p1' 					=> $notas['parametro3'],
					'parametro4_p1' 					=> $notas['parametro4'],
					'quimestre_p1' 						=> $notas['quimestre'],
					'asignatura_p1' 					=> $notas['asignatura'],
					'anioInicio_p1' 					=> $notas['anioInicio'],
					'anioFin_p1' 						=> $notas['anioFin'],
					'id_estu' 							=> $notas['id_estu']

				);
				return $this->db->insert('parcial_1', $data);
			}
			return false;
		}

		public function insertN2($notas = null)
		{
			if ($notas != null) {
				$data = array(
					'parametro1_p2' 					=> $notas['parametro1'],
					'parametro2_p2' 					=> $notas['parametro2'],
					'parametro3_p2' 					=> $notas['parametro3'],
					'parametro4_p2' 					=> $notas['parametro4'],
					'quimestre_p2' 						=> $notas['quimestre'],
					'asignatura_p2' 					=> $notas['asignatura'],
					'anioInicio_p2' 					=> $notas['anioInicio'],
					'anioFin_p2' 						=> $notas['anioFin'],
					'id_estu' 							=> $notas['id_estu']

				);
				return $this->db->insert('parcial_2', $data);
			}
			return false;
		}

		public function insertN3($notas = null)
		{
			if ($notas != null) {
				$data = array(
					'parametro1_p3' 					=> $notas['parametro1'],
					'parametro2_p3' 					=> $notas['parametro2'],
					'parametro3_p3' 					=> $notas['parametro3'],
					'parametro4_p3' 					=> $notas['parametro4'],
					'quimestre_p3' 						=> $notas['quimestre'],
					'asignatura_p3' 					=> $notas['asignatura'],
					'anioInicio_p3' 					=> $notas['anioInicio'],
					'anioFin_p3' 						=> $notas['anioFin'],
					'id_estu' 							=> $notas['id_estu']

				);
				return $this->db->insert('parcial_3', $data);
			}
			return false;
		}

		public function getInformeP1($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];
			$quimestre = $matricula['quimestre'];

			$result = $this->db->query("SELECT 
												estudiante.id_estu,
												nombres_estu,
												apellidos_estu,
												parcial_1.asignatura_p1,
												parcial_1.id_p1,
												parametro1_p1, 
												parametro2_p1, 
												parametro3_p1, 
												parametro4_p1,
												(parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1) as 'sumatoria',
												ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1) / 4 ), 2) as 'promedio'
										 FROM 
										 		estudiante, matricula, parcial_1
										 WHERE 
												matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "'
												AND parcial_1.anioInicio_p1 = '" . $anioI . "'
												AND parcial_1.anioFin_p1 = '" . $anioF . "'
												AND parcial_1.asignatura_p1 = '" . $materia . "'
												AND parcial_1.quimestre_p1 = '" . $quimestre . "'
												AND matricula.id_estu = estudiante.id_estu
												AND estudiante.id_estu = parcial_1.id_estu
										;");
			//return $result->row();
			return $result;
		}

		public function getInformeP2($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];
			$quimestre = $matricula['quimestre'];

			$result = $this->db->query("SELECT 
												estudiante.id_estu,
												nombres_estu,
												apellidos_estu,
												parcial_2.asignatura_p2,
												parcial_2.id_p2,
												parametro1_p2, 
												parametro2_p2, 
												parametro3_p2, 
												parametro4_p2,
												(parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2) as 'sumatoria',
												ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2) / 4 ), 2)
										 FROM 
										 		estudiante, matricula, parcial_2
										 WHERE 
												matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "'
												AND parcial_2.anioInicio_p2 = '" . $anioI . "'
												AND parcial_2.anioFin_p2 = '" . $anioF . "'
												AND parcial_2.asignatura_p2 = '" . $materia . "'
												AND parcial_2.quimestre_p2 = '" . $quimestre . "'
												AND matricula.id_estu = estudiante.id_estu
												AND estudiante.id_estu = parcial_2.id_estu
										;");
			//return $result->row();
			return $result;
		}

		public function getInformeP3($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];
			$quimestre = $matricula['quimestre'];

			$result = $this->db->query("SELECT 
												estudiante.id_estu,
												nombres_estu,
												apellidos_estu,
												parcial_3.asignatura_p3,
												parcial_3.id_p3,
												parametro1_p3, 
												parametro2_p3, 
												parametro3_p3, 
												parametro4_p3,
												(parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3) as 'sumatoria',
												ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3) / 4 ), 2) as 'promedio'
										 FROM 
										 		estudiante, matricula, parcial_3
										 WHERE 
												matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "'
												AND parcial_3.anioInicio_p3 = '" . $anioI . "'
												AND parcial_3.anioFin_p3 = '" . $anioF . "'
												AND parcial_3.asignatura_p3 = '" . $materia . "'
												AND parcial_3.quimestre_p3 = '" . $quimestre . "'
												AND matricula.id_estu = estudiante.id_estu
												AND estudiante.id_estu = parcial_3.id_estu
										;");
			//return $result->row();
			return $result;
		}

		public function getContar1($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];
			$quimestre = $matricula['quimestre'];

			$result = $this->db->query("SELECT 
												COUNT(*) as 'conteo'
										 FROM 
										 		estudiante, matricula, parcial_1
										 WHERE 
												matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "'
												AND parcial_1.anioInicio_p1 = '" . $anioI . "'
												AND parcial_1.anioFin_p1 = '" . $anioF . "'
												AND parcial_1.asignatura_p1 = '" . $materia . "'
												AND parcial_1.quimestre_p1 = '" . $quimestre . "'
												AND matricula.id_estu = estudiante.id_estu
												AND estudiante.id_estu = parcial_1.id_estu
										;");
			//return $result->row();
			return $result;
		}

		public function getContar2($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];
			$quimestre = $matricula['quimestre'];

			$result = $this->db->query("SELECT 
												COUNT(*) as 'conteo'
										 FROM 
										 		estudiante, matricula, parcial_2
										 WHERE 
												matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "'
												AND parcial_2.anioInicio_p2 = '" . $anioI . "'
												AND parcial_2.anioFin_p2 = '" . $anioF . "'
												AND parcial_2.asignatura_p2 = '" . $materia . "'
												AND parcial_2.quimestre_p2 = '" . $quimestre . "'
												AND matricula.id_estu = estudiante.id_estu
												AND estudiante.id_estu = parcial_2.id_estu
										;");
			//return $result->row();
			return $result;
		}

		public function getContar3($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];
			$quimestre = $matricula['quimestre'];

			$result = $this->db->query("SELECT 
												COUNT(*) as 'conteo'
										 FROM 
										 		estudiante, matricula, parcial_3
										 WHERE 
												matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "'
												AND parcial_3.anioInicio_p3 = '" . $anioI . "'
												AND parcial_3.anioFin_p3 = '" . $anioF . "'
												AND parcial_3.asignatura_p3 = '" . $materia . "'
												AND parcial_3.quimestre_p3 = '" . $quimestre . "'
												AND matricula.id_estu = estudiante.id_estu
												AND estudiante.id_estu = parcial_3.id_estu
										;");
			//return $result->row();
			return $result;
		}
	}

