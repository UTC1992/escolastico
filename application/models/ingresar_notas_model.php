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
												apellidos_estu,
												cedula_estu,
												matricula.id_curs
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
					'evaluacion_p1' 					=> $notas['evaluacion'],
					'quimestre_p1' 						=> $notas['quimestre'],
					'asignatura_p1' 					=> $notas['asignatura'],
					'anioInicio_p1' 					=> $notas['anioInicio'],
					'anioFin_p1' 						=> $notas['anioFin'],
					'id_estu' 							=> $notas['id_estu'],
					'faltas_jus_p1' 					=> $notas['faltasJus'],
					'faltas_in_p1' 						=> $notas['faltasInjus'],
					'dias_asis_p1' 						=> $notas['diasAsis'],
					'comportamiento_p1' 				=> $notas['comporta']

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
					'evaluacion_p2' 					=> $notas['evaluacion'],
					'quimestre_p2' 						=> $notas['quimestre'],
					'asignatura_p2' 					=> $notas['asignatura'],
					'anioInicio_p2' 					=> $notas['anioInicio'],
					'anioFin_p2' 						=> $notas['anioFin'],
					'id_estu' 							=> $notas['id_estu'],
					'faltas_jus_p2' 					=> $notas['faltasJus'],
					'faltas_in_p2' 						=> $notas['faltasInjus'],
					'dias_asis_p2' 						=> $notas['diasAsis'],
					'comportamiento_p2' 				=> $notas['comporta']

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
					'evaluacion_p3' 					=> $notas['evaluacion'],
					'quimestre_p3' 						=> $notas['quimestre'],
					'asignatura_p3' 					=> $notas['asignatura'],
					'anioInicio_p3' 					=> $notas['anioInicio'],
					'anioFin_p3' 						=> $notas['anioFin'],
					'id_estu' 							=> $notas['id_estu'],
					'faltas_jus_p3' 					=> $notas['faltasJus'],
					'faltas_in_p3' 						=> $notas['faltasInjus'],
					'dias_asis_p3' 						=> $notas['diasAsis'],
					'comportamiento_p3' 				=> $notas['comporta']

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
												parcial_1.asignatura_p1 as 'asignatura',
												parcial_1.id_p1 as 'id_p',
												parametro1_p1 as 'parametro1', 
												parametro2_p1 as 'parametro2', 
												parametro3_p1 as 'parametro3', 
												parametro4_p1 as 'parametro4',
												faltas_jus_p1 as 'faltasJus',
												faltas_in_p1 as 'faltasInjus',
												dias_asis_p1 as 'diasAsis',
												evaluacion_p1 as 'evaluacion',
												comportamiento_p1 as 'comporta',
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
												parcial_2.asignatura_p2 as 'asignatura',
												parcial_2.id_p2 as 'id_p',
												parametro1_p2 as 'parametro1', 
												parametro2_p2 as 'parametro2', 
												parametro3_p2 as 'parametro3', 
												parametro4_p2 as 'parametro4',
												faltas_jus_p2 as 'faltasJus',
												faltas_in_p2 as 'faltasInjus',
												dias_asis_p2 as 'diasAsis',
												evaluacion_p2 as 'evaluacion',
												comportamiento_p2 as 'comporta',
												(parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2) as 'sumatoria',
												ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2) / 4 ), 2) as 'promedio'
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
												parcial_3.asignatura_p3 as 'asignatura',
												parcial_3.id_p3 as 'id_p',
												parametro1_p3 as 'parametro1', 
												parametro2_p3 as 'parametro2', 
												parametro3_p3 as 'parametro3', 
												parametro4_p3 as 'parametro4',
												faltas_jus_p3 as 'faltasJus',
												faltas_in_p3 as 'faltasInjus',
												dias_asis_p3 as 'diasAsis',
												evaluacion_p3 as 'evaluacion',
												comportamiento_p3 as 'comporta',
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

		public function getNotasEdit1($id = '')
		{
			$result = $this->db->query("SELECT 
						 					id_p1 as 'id_p',
											parametro1_p1 as 'parametro1', 
											parametro2_p1 as 'parametro2', 
											parametro3_p1 as 'parametro3', 
											parametro4_p1 as 'parametro4',
											faltas_jus_p1 as 'faltasJus',
											faltas_in_p1 as 'faltasInjus',
											dias_asis_p1 as 'diasAsis',
											comportamiento_p1 as 'comporta',
											evaluacion_p1 as 'evaluacion'
										 FROM parcial_1 WHERE id_p1 = '" . $id . "'");
			//return $result->row();
			return $result;
		}

		public function getNotasEdit2($id = '')
		{
			$result = $this->db->query("SELECT 
											id_p2 as 'id_p',
											parametro1_p2 as 'parametro1', 
											parametro2_p2 as 'parametro2', 
											parametro3_p2 as 'parametro3', 
											parametro4_p2 as 'parametro4',
											faltas_jus_p2 as 'faltasJus',
											faltas_in_p2 as 'faltasInjus',
											dias_asis_p2 as 'diasAsis',
											comportamiento_p2 as 'comporta',
											evaluacion_p2 as 'evaluacion'
										 FROM parcial_2 WHERE id_p2 = '" . $id . "'");
			//return $result->row();
			return $result;
		}

		public function getNotasEdit3($id = '')
		{
			$result = $this->db->query("SELECT
											id_p3 as 'id_p',
											parametro1_p3 as 'parametro1', 
											parametro2_p3 as 'parametro2', 
											parametro3_p3 as 'parametro3', 
											parametro4_p3 as 'parametro4',
											faltas_jus_p3 as 'faltasJus',
											faltas_in_p3 as 'faltasInjus',
											dias_asis_p3 as 'diasAsis',
											comportamiento_p3 as 'comporta',
											evaluacion_p3 as 'evaluacion'
										FROM parcial_3 WHERE id_p3 = '" . $id . "'");
			//return $result->row();
			return $result;
		}

		public function updateP1($parcial = null, $id = '')
		{
			if ($parcial != null) {
				$data = array(
					'parametro1_p1' 		=> $parcial['parametro1'],
					'parametro2_p1' 		=> $parcial['parametro2'],
					'parametro3_p1' 		=> $parcial['parametro3'],
					'parametro4_p1' 		=> $parcial['parametro4'],
					'faltas_jus_p1' 		=> $parcial['faltasJus'],
					'faltas_in_p1'	 		=> $parcial['faltasInjus'],
					'dias_asis_p1' 			=> $parcial['diasAsis'],
					'comportamiento_p1' 	=> $parcial['comporta']
				);
				$this->db->where('id_p1', $id);
				return $this->db->update('parcial_1', $data);
			}
			return false;
		}

		public function updateP2($parcial = null, $id = '')
		{
			if ($parcial != null) {
				$data = array(
					'parametro1_p2' 		=> $parcial['parametro1'],
					'parametro2_p2' 		=> $parcial['parametro2'],
					'parametro3_p2' 		=> $parcial['parametro3'],
					'parametro4_p2' 		=> $parcial['parametro4'],
					'faltas_jus_p2' 		=> $parcial['faltasJus'],
					'faltas_in_p2'	 		=> $parcial['faltasInjus'],
					'dias_asis_p2' 			=> $parcial['diasAsis'],
					'comportamiento_p2' 	=> $parcial['comporta']
				);
				$this->db->where('id_p2', $id);
				return $this->db->update('parcial_2', $data);
			}
			return false;
		}

		public function updateP3($parcial = null, $id = '')
		{
			if ($parcial != null) {
				$data = array(
					'parametro1_p3' 		=> $parcial['parametro1'],
					'parametro2_p3' 		=> $parcial['parametro2'],
					'parametro3_p3' 		=> $parcial['parametro3'],
					'parametro4_p3' 		=> $parcial['parametro4'],
					'faltas_jus_p3' 		=> $parcial['faltasJus'],
					'faltas_in_p3'	 		=> $parcial['faltasInjus'],
					'dias_asis_p3' 			=> $parcial['diasAsis'],
					'comportamiento_p3' 	=> $parcial['comporta']
				);
				$this->db->where('id_p3', $id);
				return $this->db->update('parcial_3', $data);
			}
			return false;
		}

		/*==============================EXAMENES====================================*/

		public function getContarExa1($matricula = '')
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
										 		estudiante, matricula, examen
										 WHERE 
												matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "'
												AND examen.anioInicio_exa = '" . $anioI . "'
												AND examen.anioFin_exa = '" . $anioF . "'
												AND examen.asignatura_exa = '" . $materia . "'
												AND examen.quimestre_exa = '" . $quimestre . "'
												AND matricula.id_estu = estudiante.id_estu
												AND estudiante.id_estu = examen.id_estu 
										;");
			//return $result->row();
			return $result;
		}

		public function insertExa($notas = null)
		{
			if ($notas != null) {
				$data = array(
					'nota_exa'		 					=> $notas['examen'],
					'quimestre_exa' 					=> $notas['quimestre'],
					'asignatura_exa' 					=> $notas['asignatura'],
					'anioInicio_exa' 					=> $notas['anioInicio'],
					'anioFin_exa' 						=> $notas['anioFin'],
					'id_estu' 							=> $notas['id_estu']

				);
				return $this->db->insert('examen', $data);
			}
			return false;
		}

		public function getExamenes($matricula = '')
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
												examen.asignatura_exa as 'asignatura',
												examen.id_exa as 'id_exa',
												nota_exa
										 FROM 
										 		estudiante, matricula, examen
										 WHERE 
												matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "'
												AND examen.anioInicio_exa = '" . $anioI . "'
												AND examen.anioFin_exa = '" . $anioF . "'
												AND examen.asignatura_exa = '" . $materia . "'
												AND examen.quimestre_exa = '" . $quimestre . "'
												AND matricula.id_estu = estudiante.id_estu
												AND estudiante.id_estu = examen.id_estu 
										;");
			//return $result->row();
			return $result;
		}

		public function getNotasExaEdit($id = '')
		{
			$result = $this->db->query("SELECT * FROM examen WHERE id_exa = '" . $id . "'");
			//return $result->row();
			return $result;
		}

		public function updateExa($notasEdit = '', $id = '')
		{
			if ($notasEdit != null) {
				$data = array(
					'nota_exa' 		=> $notasEdit['notaExa']
				);
				$this->db->where('id_exa', $id);
				return $this->db->update('examen', $data);
			}
			return false;
		}

		/*====================================EXAMMENES SUPLETORIO==========================================*/

		public function getNotasTotales($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];
			$cedula = $matricula['cedula'];
			
			$result = $this->db->query("SELECT 
							T1.id_estu, T1.nombres_estu, T1.apellidos_estu, T1.asignatura_p1, 
							T1.promedio1, T1.promedio2,T1.promedio3,
							(((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) as '80nota', T1.nota_exa,
							(T1.nota_exa * 0.2) as '20nota',
							ROUND
							(
								( (((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) + (T1.nota_exa * 0.2) ), 2
							)
							as 'NotaQ1',
							T2.promedio1, T2.promedio2, T2.promedio3,

							(((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) as '80%  de la Nota', T2.nota_exa,
							(T2.nota_exa * 0.2) as '20% de nota',
							ROUND
							(
								( (((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) + (T2.nota_exa * 0.2) ), 2
							)
							as 'NotaQ2',
							ROUND(
							(  ((((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) + (T2.nota_exa * 0.2)) 
							+ ((((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) + (T1.nota_exa * 0.2))  ) / 2
							, 2) as 'NotaF'
    
						FROM(
						SELECT
							estudiante.id_estu as 'id_estu',nombres_estu, apellidos_estu, asignatura_p1,
							(parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) as 'sumatoria1',
							ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'promedio1',
							(parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) as 'sumatoria2',
							ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'promedio2',
							(parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) as 'sumatoria3',
							ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'promedio3',
							nota_exa
						FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen
						WHERE estudiante.cedula_estu = '" . $cedula . "'
						AND matricula.id_curs = '" . $cursoId . "'
						AND parcial_1.quimestre_p1 = '1ero'
						AND parcial_1.anioInicio_p1 = '" . $anioI . "'
						AND parcial_1.anioFin_p1 = '" . $anioF . "'
						AND parcial_2.quimestre_p2 = '1ero'
						AND parcial_2.anioInicio_p2 = '" . $anioI . "'
						AND parcial_2.anioFin_p2 = '" . $anioF . "'
						AND parcial_3.quimestre_p3 = '1ero'
						AND parcial_3.anioInicio_p3 = '" . $anioI . "'
						AND parcial_3.anioFin_p3 = '" . $anioF . "'
						AND parcial_1.asignatura_p1 = '" . $materia . "'
						AND parcial_2.asignatura_p2 = '" . $materia . "'
						AND parcial_3.asignatura_p3 = '" . $materia . "'
						AND estudiante.id_estu = parcial_1.id_estu
						AND estudiante.id_estu = parcial_2.id_estu
						AND estudiante.id_estu = parcial_3.id_estu
						AND matricula.id_estu = estudiante.id_estu
						AND examen.id_estu = estudiante.id_estu
						AND examen.asignatura_exa = '" . $materia . "'
						AND examen.quimestre_exa = '1ero'
						AND examen.anioInicio_exa = '" . $anioI . "'
						AND examen.anioFin_exa = '" . $anioF . "'
						) T1
						inner join
						(
						SELECT 	nombres_estu, apellidos_estu, asignatura_p1,
								(parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) as 'sumatoria1',
							ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'promedio1',
							(parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) as 'sumatoria2',
							ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'promedio2',
							(parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) as 'sumatoria3',
							ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'promedio3',
								nota_exa
						FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen
						WHERE estudiante.cedula_estu = '" . $cedula . "'
						AND matricula.id_curs = '" . $cursoId . "'
						AND parcial_1.quimestre_p1 = '2do'
						AND parcial_1.anioInicio_p1 = '" . $anioI . "'
						AND parcial_1.anioFin_p1 = '" . $anioF . "'
						AND parcial_2.quimestre_p2 = '2do'
						AND parcial_2.anioInicio_p2 = '" . $anioI . "'
						AND parcial_2.anioFin_p2 = '" . $anioF . "'
						AND parcial_3.quimestre_p3 = '2do'
						AND parcial_3.anioInicio_p3 = '" . $anioI . "'
						AND parcial_3.anioFin_p3 = '" . $anioF . "'
						AND parcial_1.asignatura_p1 = '" . $materia . "'
						AND parcial_2.asignatura_p2 = '" . $materia . "'
						AND parcial_3.asignatura_p3 = '" . $materia . "'
						AND estudiante.id_estu = parcial_1.id_estu
						AND estudiante.id_estu = parcial_2.id_estu
						AND estudiante.id_estu = parcial_3.id_estu
						AND matricula.id_estu = estudiante.id_estu
						AND examen.id_estu = estudiante.id_estu
						AND examen.asignatura_exa = '" . $materia . "'
						AND examen.quimestre_exa = '2do'
						AND examen.anioInicio_exa = '" . $anioI . "'
						AND examen.anioFin_exa = '" . $anioF . "'
						) T2
						;");
			//return $result->row();
			return $result;
		}

		public function getNotasTotalesSupletorio($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];
			$cedula = $matricula['cedula'];
			
			$result = $this->db->query("SELECT 
							T1.id_estu, T1.nombres_estu, T1.apellidos_estu, T1.asignatura_p1, T1.id_suple,
							T1.promedio1, T1.promedio2,T1.promedio3,
							(((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) as '80nota', T1.nota_exa,
							(T1.nota_exa * 0.2) as '20nota',
							( (((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) + (T1.nota_exa * 0.2) ) as 'NotaQ1',
							T2.promedio1, T2.promedio2, T2.promedio3,
							(((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) as '80%  de la Nota', T2.nota_exa,
							(T2.nota_exa * 0.2) as '20% de nota',
							( (((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) + (T2.nota_exa * 0.2) ) as 'NotaQ2',
							ROUND(
							(  ((((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) + (T2.nota_exa * 0.2)) 
							+ ((((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) + (T1.nota_exa * 0.2))  ) / 2
							, 2) as 'NotaF',
							T1.nota_suple as 'notaSuple',
							ROUND(
							(  ((((((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) + (T2.nota_exa * 0.2)) 
							+ ((((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) + (T1.nota_exa * 0.2))  ) / 2) 
							+ T1.nota_suple) / 2
							, 2) as 'NotaFSuple'
    
						FROM(
						SELECT
							estudiante.id_estu as 'id_estu',nombres_estu, apellidos_estu, asignatura_p1,
							(parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) as 'sumatoria1',
							ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'promedio1',
							(parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) as 'sumatoria2',
							ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'promedio2',
							(parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) as 'sumatoria3',
							ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'promedio3',
							nota_exa, nota_suple, id_suple
						FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen, examen_suple
						WHERE estudiante.cedula_estu = '" . $cedula . "'
						AND matricula.id_curs = '" . $cursoId . "'
						AND parcial_1.quimestre_p1 = '1ero'
						AND parcial_1.anioInicio_p1 = '" . $anioI . "'
						AND parcial_1.anioFin_p1 = '" . $anioF . "'
						AND parcial_2.quimestre_p2 = '1ero'
						AND parcial_2.anioInicio_p2 = '" . $anioI . "'
						AND parcial_2.anioFin_p2 = '" . $anioF . "'
						AND parcial_3.quimestre_p3 = '1ero'
						AND parcial_3.anioInicio_p3 = '" . $anioI . "'
						AND parcial_3.anioFin_p3 = '" . $anioF . "'
						AND parcial_1.asignatura_p1 = '" . $materia . "'
						AND parcial_2.asignatura_p2 = '" . $materia . "'
						AND parcial_3.asignatura_p3 = '" . $materia . "'
						AND estudiante.id_estu = parcial_1.id_estu
						AND estudiante.id_estu = parcial_2.id_estu
						AND estudiante.id_estu = parcial_3.id_estu
						AND matricula.id_estu = estudiante.id_estu
						AND examen.id_estu = estudiante.id_estu
						AND examen.asignatura_exa = '" . $materia . "'
						AND examen.quimestre_exa = '1ero'
						AND examen.anioInicio_exa = '" . $anioI . "'
						AND examen.anioFin_exa = '" . $anioF . "'
						AND examen_suple.id_estu = estudiante.id_estu
						AND examen_suple.anioInicio_suple = '" . $anioI . "'
						AND examen_suple.anioFin_suple = '" . $anioF . "'
						AND examen_suple.asignatura_suple = '" . $materia . "'
						) T1
						inner join
						(
						SELECT 	nombres_estu, apellidos_estu, asignatura_p1,
								(parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) as 'sumatoria1',
							ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'promedio1',
							(parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) as 'sumatoria2',
							ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'promedio2',
							(parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) as 'sumatoria3',
							ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'promedio3',
								nota_exa, nota_suple
						FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen, examen_suple
						WHERE estudiante.cedula_estu = '" . $cedula . "'
						AND matricula.id_curs = '" . $cursoId . "'
						AND parcial_1.quimestre_p1 = '2do'
						AND parcial_1.anioInicio_p1 = '" . $anioI . "'
						AND parcial_1.anioFin_p1 = '" . $anioF . "'
						AND parcial_2.quimestre_p2 = '2do'
						AND parcial_2.anioInicio_p2 = '" . $anioI . "'
						AND parcial_2.anioFin_p2 = '" . $anioF . "'
						AND parcial_3.quimestre_p3 = '2do'
						AND parcial_3.anioInicio_p3 = '" . $anioI . "'
						AND parcial_3.anioFin_p3 = '" . $anioF . "'
						AND parcial_1.asignatura_p1 = '" . $materia . "'
						AND parcial_2.asignatura_p2 = '" . $materia . "'
						AND parcial_3.asignatura_p3 = '" . $materia . "'
						AND estudiante.id_estu = parcial_1.id_estu
						AND estudiante.id_estu = parcial_2.id_estu
						AND estudiante.id_estu = parcial_3.id_estu
						AND matricula.id_estu = estudiante.id_estu
						AND examen.id_estu = estudiante.id_estu
						AND examen.asignatura_exa = '" . $materia . "'
						AND examen.quimestre_exa = '2do'
						AND examen.anioInicio_exa = '" . $anioI . "'
						AND examen.anioFin_exa = '" . $anioF . "'
						AND examen_suple.id_estu = estudiante.id_estu
						AND examen_suple.anioInicio_suple = '" . $anioI . "'
						AND examen_suple.anioFin_suple = '" . $anioF . "'
						AND examen_suple.asignatura_suple = '" . $materia . "'
						) T2
						;");
			//return $result->row();
			return $result;
		}

		public function getContarExaSuple($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];

			$result = $this->db->query("SELECT 
												COUNT(*) as 'conteo'
										 FROM 
										 		estudiante, matricula, examen_suple
										 WHERE 
												matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "'
												AND examen_suple.anioInicio_suple = '" . $anioI . "'
												AND examen_suple.anioFin_suple = '" . $anioF . "'
												AND examen_suple.asignatura_suple = '" . $materia . "'
												AND matricula.id_estu = estudiante.id_estu
												AND estudiante.id_estu = examen_suple.id_estu 
										;");
			//return $result->row();
			return $result;
		}

		public function insertExaSuple($notas = null)
		{
			if ($notas != null) {
				$data = array(
					'nota_suple'		 				=> $notas['examen'],
					'asignatura_suple' 					=> $notas['asignatura'],
					'anioInicio_suple' 					=> $notas['anioInicio'],
					'anioFin_suple' 					=> $notas['anioFin'],
					'id_estu' 							=> $notas['id_estu']

				);
				return $this->db->insert('examen_suple', $data);
			}
			return false;
		}

		public function getNotasSupleEdit($id = '')
		{
			$result = $this->db->query("SELECT * FROM examen_suple WHERE id_suple = '" . $id . "'");
			//return $result->row();
			return $result;
		}

		public function updateSuple($notasEdit = '', $id = '')
		{
			if ($notasEdit != null) {
				$data = array(
					'nota_suple' 		=> $notasEdit['notaSuple']
				);
				$this->db->where('id_suple', $id);
				return $this->db->update('examen_suple', $data);
			}
			return false;
		}

		public function getNotasMejoraId($matricula = '')
		{
			$idEstu = $matricula['idEstu'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];

			$result = $this->db->query("SELECT 
												nota_mejo
										 FROM 
										 		examen_mejora
										 WHERE 
												examen_mejora.anioInicio_mejo = '" . $anioI . "'
												AND examen_mejora.anioFin_mejo = '" . $anioF . "'
												AND examen_mejora.asignatura_mejo = '" . $materia . "'
												AND examen_mejora.id_estu = '" . $idEstu . "'
										;");
			//return $result->row();
			return $result;
		}

		/*========================================EXAMENES MEJORA================================================*/
		public function getContarExaMejora($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];

			$result = $this->db->query("SELECT 
												COUNT(*) as 'conteo'
										 FROM 
										 		estudiante, matricula, examen_mejora
										 WHERE 
												matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "'
												AND examen_mejora.anioInicio_mejo = '" . $anioI . "'
												AND examen_mejora.anioFin_mejo = '" . $anioF . "'
												AND examen_mejora.asignatura_mejo = '" . $materia . "'
												AND matricula.id_estu = estudiante.id_estu
												AND estudiante.id_estu = examen_mejora.id_estu 
										;");
			//return $result->row();
			return $result;
		}

		public function insertExaMejora($notas = null)
		{
			if ($notas != null) {
				$data = array(
					'nota_mejo'		 				=> $notas['examen'],
					'asignatura_mejo' 				=> $notas['asignatura'],
					'anioInicio_mejo' 				=> $notas['anioInicio'],
					'anioFin_mejo' 					=> $notas['anioFin'],
					'id_estu' 						=> $notas['id_estu']

				);
				return $this->db->insert('examen_mejora', $data);
			}
			return false;
		}
		
		public function getNotasTotalesMejora($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];
			$cedula = $matricula['cedula'];
			
			$result = $this->db->query("SELECT 
							T1.id_estu, T1.nombres_estu, T1.apellidos_estu, T1.asignatura_p1, T1.id_mejo,
							T1.promedio1, T1.promedio2,T1.promedio3,
							(((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) as '80nota', T1.nota_exa,
							(T1.nota_exa * 0.2) as '20nota',
							ROUND
							(
								( (((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) + (T1.nota_exa * 0.2) ), 2
							)
							as 'NotaQ1',
							T2.promedio1, T2.promedio2, T2.promedio3,

							(((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) as '80%  de la Nota', T2.nota_exa,
							(T2.nota_exa * 0.2) as '20% de nota',
							ROUND
							(
								( (((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) + (T2.nota_exa * 0.2) ), 2
							)
							as 'NotaQ2',
							ROUND(
							(  ((((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) + (T2.nota_exa * 0.2)) 
							+ ((((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) + (T1.nota_exa * 0.2))  ) / 2
							, 2) as 'NotaF',
							T1.nota_mejo as 'notaMejora'
    
						FROM(
						SELECT
							estudiante.id_estu as 'id_estu',nombres_estu, apellidos_estu, asignatura_p1,
							(parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) as 'sumatoria1',
							ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'promedio1',
							(parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) as 'sumatoria2',
							ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'promedio2',
							(parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) as 'sumatoria3',
							ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'promedio3',
							nota_exa, nota_mejo, id_mejo
						FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen, examen_mejora
						WHERE estudiante.cedula_estu = '" . $cedula . "'
						AND matricula.id_curs = '" . $cursoId . "'
						AND parcial_1.quimestre_p1 = '1ero'
						AND parcial_1.anioInicio_p1 = '" . $anioI . "'
						AND parcial_1.anioFin_p1 = '" . $anioF . "'
						AND parcial_2.quimestre_p2 = '1ero'
						AND parcial_2.anioInicio_p2 = '" . $anioI . "'
						AND parcial_2.anioFin_p2 = '" . $anioF . "'
						AND parcial_3.quimestre_p3 = '1ero'
						AND parcial_3.anioInicio_p3 = '" . $anioI . "'
						AND parcial_3.anioFin_p3 = '" . $anioF . "'
						AND parcial_1.asignatura_p1 = '" . $materia . "'
						AND parcial_2.asignatura_p2 = '" . $materia . "'
						AND parcial_3.asignatura_p3 = '" . $materia . "'
						AND estudiante.id_estu = parcial_1.id_estu
						AND estudiante.id_estu = parcial_2.id_estu
						AND estudiante.id_estu = parcial_3.id_estu
						AND matricula.id_estu = estudiante.id_estu
						AND examen.id_estu = estudiante.id_estu
						AND examen.asignatura_exa = '" . $materia . "'
						AND examen.quimestre_exa = '1ero'
						AND examen.anioInicio_exa = '" . $anioI . "'
						AND examen.anioFin_exa = '" . $anioF . "'
						AND examen_mejora.id_estu = estudiante.id_estu
						AND examen_mejora.anioInicio_mejo = '" . $anioI . "'
						AND examen_mejora.anioFin_mejo = '" . $anioF . "'
						AND examen_mejora.asignatura_mejo = '" . $materia . "'
						) T1
						inner join
						(
						SELECT 	nombres_estu, apellidos_estu, asignatura_p1,
							(parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) as 'sumatoria1',
							ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'promedio1',
							(parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) as 'sumatoria2',
							ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'promedio2',
							(parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) as 'sumatoria3',
							ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'promedio3',
								nota_exa, nota_mejo
						FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen, examen_mejora
						WHERE estudiante.cedula_estu = '" . $cedula . "'
						AND matricula.id_curs = '" . $cursoId . "'
						AND parcial_1.quimestre_p1 = '2do'
						AND parcial_1.anioInicio_p1 = '" . $anioI . "'
						AND parcial_1.anioFin_p1 = '" . $anioF . "'
						AND parcial_2.quimestre_p2 = '2do'
						AND parcial_2.anioInicio_p2 = '" . $anioI . "'
						AND parcial_2.anioFin_p2 = '" . $anioF . "'
						AND parcial_3.quimestre_p3 = '2do'
						AND parcial_3.anioInicio_p3 = '" . $anioI . "'
						AND parcial_3.anioFin_p3 = '" . $anioF . "'
						AND parcial_1.asignatura_p1 = '" . $materia . "'
						AND parcial_2.asignatura_p2 = '" . $materia . "'
						AND parcial_3.asignatura_p3 = '" . $materia . "'
						AND estudiante.id_estu = parcial_1.id_estu
						AND estudiante.id_estu = parcial_2.id_estu
						AND estudiante.id_estu = parcial_3.id_estu
						AND matricula.id_estu = estudiante.id_estu
						AND examen.id_estu = estudiante.id_estu
						AND examen.asignatura_exa = '" . $materia . "'
						AND examen.quimestre_exa = '2do'
						AND examen.anioInicio_exa = '" . $anioI . "'
						AND examen.anioFin_exa = '" . $anioF . "'
						AND examen_mejora.id_estu = estudiante.id_estu
						AND examen_mejora.anioInicio_mejo = '" . $anioI . "'
						AND examen_mejora.anioFin_mejo = '" . $anioF . "'
						AND examen_mejora.asignatura_mejo = '" . $materia . "'
						) T2
						;");
			//return $result->row();
			return $result;
		}
		
		public function getNotasMejoraEdit($id = '')
		{
			$result = $this->db->query("SELECT * FROM examen_mejora WHERE id_mejo = '" . $id . "'");
			//return $result->row();
			return $result;
		}

		public function updateMejora($notasEdit = '', $id = '')
		{
			if ($notasEdit != null) {
				$data = array(
					'nota_mejo' 		=> $notasEdit['nota']
				);
				$this->db->where('id_mejo', $id);
				return $this->db->update('examen_mejora', $data);
			}
			return false;
		}

		/*==============================================EXAMEN REMEDIAL===========================================================*/
		
		public function getContarExaRemedial($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];

			$result = $this->db->query("SELECT 
												COUNT(*) as 'conteo'
										 FROM 
										 		estudiante, matricula, examen_remedial
										 WHERE 
												matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "'
												AND examen_remedial.anioInicio_reme = '" . $anioI . "'
												AND examen_remedial.anioFin_reme = '" . $anioF . "'
												AND examen_remedial.asignatura_reme = '" . $materia . "'
												AND matricula.id_estu = estudiante.id_estu
												AND estudiante.id_estu = examen_remedial.id_estu 
										;");
			//return $result->row();
			return $result;
		}
		
		public function insertExaRemedial($notas = null)
		{
			if ($notas != null) {
				$data = array(
					'nota_reme'		 				=> $notas['examen'],
					'asignatura_reme' 				=> $notas['asignatura'],
					'anioInicio_reme' 				=> $notas['anioInicio'],
					'anioFin_reme' 					=> $notas['anioFin'],
					'id_estu' 						=> $notas['id_estu']

				);
				return $this->db->insert('examen_remedial', $data);
			}
			return false;
		}
		
		public function getNotasTotalesRemedial($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];
			$cedula = $matricula['cedula'];
			
			$result = $this->db->query("SELECT 
							T1.id_estu, T1.nombres_estu, T1.apellidos_estu, T1.asignatura_p1, T1.id_reme,
							T1.promedio1, T1.promedio2,T1.promedio3,
							(((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) as '80nota', T1.nota_exa,
							(T1.nota_exa * 0.2) as '20nota',
							ROUND
							(
								( (((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) + (T1.nota_exa * 0.2) ), 2
							)
							as 'NotaQ1',
							T2.promedio1, T2.promedio2, T2.promedio3,

							(((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) as '80%  de la Nota', T2.nota_exa,
							(T2.nota_exa * 0.2) as '20% de nota',
							ROUND
							(
								( (((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) + (T2.nota_exa * 0.2) ), 2
							)
							as 'NotaQ2',
							ROUND(
							(  ((((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) + (T2.nota_exa * 0.2)) 
							+ ((((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) + (T1.nota_exa * 0.2))  ) / 2
							, 2) as 'NotaF',
							T1.nota_reme as 'notaRemedial'
    
						FROM(
						SELECT
							estudiante.id_estu as 'id_estu',nombres_estu, apellidos_estu, asignatura_p1,
							(parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) as 'sumatoria1',
							ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'promedio1',
							(parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) as 'sumatoria2',
							ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'promedio2',
							(parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) as 'sumatoria3',
							ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'promedio3',
							nota_exa, nota_reme, id_reme
						FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen, examen_remedial
						WHERE estudiante.cedula_estu = '" . $cedula . "'
						AND matricula.id_curs = '" . $cursoId . "'
						AND parcial_1.quimestre_p1 = '1ero'
						AND parcial_1.anioInicio_p1 = '" . $anioI . "'
						AND parcial_1.anioFin_p1 = '" . $anioF . "'
						AND parcial_2.quimestre_p2 = '1ero'
						AND parcial_2.anioInicio_p2 = '" . $anioI . "'
						AND parcial_2.anioFin_p2 = '" . $anioF . "'
						AND parcial_3.quimestre_p3 = '1ero'
						AND parcial_3.anioInicio_p3 = '" . $anioI . "'
						AND parcial_3.anioFin_p3 = '" . $anioF . "'
						AND parcial_1.asignatura_p1 = '" . $materia . "'
						AND parcial_2.asignatura_p2 = '" . $materia . "'
						AND parcial_3.asignatura_p3 = '" . $materia . "'
						AND estudiante.id_estu = parcial_1.id_estu
						AND estudiante.id_estu = parcial_2.id_estu
						AND estudiante.id_estu = parcial_3.id_estu
						AND matricula.id_estu = estudiante.id_estu
						AND examen.id_estu = estudiante.id_estu
						AND examen.asignatura_exa = '" . $materia . "'
						AND examen.quimestre_exa = '1ero'
						AND examen.anioInicio_exa = '" . $anioI . "'
						AND examen.anioFin_exa = '" . $anioF . "'
						AND examen_remedial.id_estu = estudiante.id_estu
						AND examen_remedial.anioInicio_reme = '" . $anioI . "'
						AND examen_remedial.anioFin_reme = '" . $anioF . "'
						AND examen_remedial.asignatura_reme = '" . $materia . "'
						) T1
						inner join
						(
						SELECT 	nombres_estu, apellidos_estu, asignatura_p1,
								(parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) as 'sumatoria1',
							ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'promedio1',
							(parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) as 'sumatoria2',
							ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'promedio2',
							(parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) as 'sumatoria3',
							ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'promedio3',
								nota_exa, nota_reme
						FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen, examen_remedial
						WHERE estudiante.cedula_estu = '" . $cedula . "'
						AND matricula.id_curs = '" . $cursoId . "'
						AND parcial_1.quimestre_p1 = '2do'
						AND parcial_1.anioInicio_p1 = '" . $anioI . "'
						AND parcial_1.anioFin_p1 = '" . $anioF . "'
						AND parcial_2.quimestre_p2 = '2do'
						AND parcial_2.anioInicio_p2 = '" . $anioI . "'
						AND parcial_2.anioFin_p2 = '" . $anioF . "'
						AND parcial_3.quimestre_p3 = '2do'
						AND parcial_3.anioInicio_p3 = '" . $anioI . "'
						AND parcial_3.anioFin_p3 = '" . $anioF . "'
						AND parcial_1.asignatura_p1 = '" . $materia . "'
						AND parcial_2.asignatura_p2 = '" . $materia . "'
						AND parcial_3.asignatura_p3 = '" . $materia . "'
						AND estudiante.id_estu = parcial_1.id_estu
						AND estudiante.id_estu = parcial_2.id_estu
						AND estudiante.id_estu = parcial_3.id_estu
						AND matricula.id_estu = estudiante.id_estu
						AND examen.id_estu = estudiante.id_estu
						AND examen.asignatura_exa = '" . $materia . "'
						AND examen.quimestre_exa = '2do'
						AND examen.anioInicio_exa = '" . $anioI . "'
						AND examen.anioFin_exa = '" . $anioF . "'
						AND examen_remedial.id_estu = estudiante.id_estu
						AND examen_remedial.anioInicio_reme = '" . $anioI . "'
						AND examen_remedial.anioFin_reme = '" . $anioF . "'
						AND examen_remedial.asignatura_reme = '" . $materia . "'
						) T2
						;");
			//return $result->row();
			return $result;
		}
		
		public function getNotasRemedialEdit($id = '')
		{
			$result = $this->db->query("SELECT * FROM examen_remedial WHERE id_reme = '" . $id . "'");
			//return $result->row();
			return $result;
		}
		
		public function updateRemedial($notasEdit = '', $id = '')
		{
			if ($notasEdit != null) {
				$data = array(
					'nota_reme' 		=> $notasEdit['nota']
				);
				$this->db->where('id_reme', $id);
				return $this->db->update('examen_remedial', $data);
			}
			return false;
		}

		/*==============================================EXAMEN GRACIA===========================================================*/
		
		public function getContarExaGracia($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];

			$result = $this->db->query("SELECT 
												COUNT(*) as 'conteo'
										 FROM 
										 		estudiante, matricula, examen_gracia
										 WHERE 
												matricula.id_curs = '" . $cursoId . "'
												AND matricula.paralelo_matr = '" . $paralelo . "'
												AND examen_gracia.anioInicio_gra = '" . $anioI . "'
												AND examen_gracia.anioFin_gra = '" . $anioF . "'
												AND examen_gracia.asignatura_gra = '" . $materia . "'
												AND matricula.id_estu = estudiante.id_estu
												AND estudiante.id_estu = examen_gracia.id_estu 
										;");
			//return $result->row();
			return $result;
		}
		
		public function insertExaGracia($notas = null)
		{
			if ($notas != null) {
				$data = array(
					'nota_gra'		 				=> $notas['examen'],
					'asignatura_gra' 				=> $notas['asignatura'],
					'anioInicio_gra' 				=> $notas['anioInicio'],
					'anioFin_gra' 					=> $notas['anioFin'],
					'id_estu' 						=> $notas['id_estu']

				);
				return $this->db->insert('examen_gracia', $data);
			}
			return false;
		}
		
		public function getNotasTotalesGracia($matricula = '')
		{
			$cursoId = $matricula['cursoId'];
			$paralelo = $matricula['paralelo'];
			$anioI = $matricula['anioI'];
			$anioF = $matricula['anioF'];
			$materia = $matricula['materia'];
			$cedula = $matricula['cedula'];
			
			$result = $this->db->query("SELECT 
							T1.id_estu, T1.nombres_estu, T1.apellidos_estu, T1.asignatura_p1, T1.id_gra,
							T1.promedio1, T1.promedio2,T1.promedio3,
							(((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) as '80nota', T1.nota_exa,
							(T1.nota_exa * 0.2) as '20nota',
							ROUND
							(
								( (((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) + (T1.nota_exa * 0.2) ), 2
							)
							as 'NotaQ1',
							T2.promedio1, T2.promedio2, T2.promedio3,

							(((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) as '80%  de la Nota', T2.nota_exa,
							(T2.nota_exa * 0.2) as '20% de nota',
							ROUND
							(
								( (((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) + (T2.nota_exa * 0.2) ), 2
							)
							as 'NotaQ2',
							ROUND(
							(  ((((T2.promedio1 + T2.promedio2 + T2.promedio3) / 3)*0.8) + (T2.nota_exa * 0.2)) 
							+ ((((T1.promedio1 + T1.promedio2 + T1.promedio3) / 3)*0.8) + (T1.nota_exa * 0.2))  ) / 2
							, 2) as 'NotaF',
							T1.nota_gra as 'notaGracia'
    
						FROM(
						SELECT
							estudiante.id_estu as 'id_estu',nombres_estu, apellidos_estu, asignatura_p1,
							(parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) as 'sumatoria1',
							ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'promedio1',
							(parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) as 'sumatoria2',
							ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'promedio2',
							(parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) as 'sumatoria3',
							ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'promedio3',
							nota_exa, nota_gra, id_gra
						FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen, examen_gracia
						WHERE estudiante.cedula_estu = '" . $cedula . "'
						AND matricula.id_curs = '" . $cursoId . "'
						AND parcial_1.quimestre_p1 = '1ero'
						AND parcial_1.anioInicio_p1 = '" . $anioI . "'
						AND parcial_1.anioFin_p1 = '" . $anioF . "'
						AND parcial_2.quimestre_p2 = '1ero'
						AND parcial_2.anioInicio_p2 = '" . $anioI . "'
						AND parcial_2.anioFin_p2 = '" . $anioF . "'
						AND parcial_3.quimestre_p3 = '1ero'
						AND parcial_3.anioInicio_p3 = '" . $anioI . "'
						AND parcial_3.anioFin_p3 = '" . $anioF . "'
						AND parcial_1.asignatura_p1 = '" . $materia . "'
						AND parcial_2.asignatura_p2 = '" . $materia . "'
						AND parcial_3.asignatura_p3 = '" . $materia . "'
						AND estudiante.id_estu = parcial_1.id_estu
						AND estudiante.id_estu = parcial_2.id_estu
						AND estudiante.id_estu = parcial_3.id_estu
						AND matricula.id_estu = estudiante.id_estu
						AND examen.id_estu = estudiante.id_estu
						AND examen.asignatura_exa = '" . $materia . "'
						AND examen.quimestre_exa = '1ero'
						AND examen.anioInicio_exa = '" . $anioI . "'
						AND examen.anioFin_exa = '" . $anioF . "'
						AND examen_gracia.id_estu = estudiante.id_estu
						AND examen_gracia.anioInicio_gra = '" . $anioI . "'
						AND examen_gracia.anioFin_gra = '" . $anioF . "'
						AND examen_gracia.asignatura_gra = '" . $materia . "'
						) T1
						inner join
						(
						SELECT 	nombres_estu, apellidos_estu, asignatura_p1,
								(parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) as 'sumatoria1',
								ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'promedio1',
								(parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) as 'sumatoria2',
								ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'promedio2',
								(parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) as 'sumatoria3',
								ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'promedio3',
								nota_exa, nota_gra
						FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen, examen_gracia
						WHERE estudiante.cedula_estu = '" . $cedula . "'
						AND matricula.id_curs = '" . $cursoId . "'
						AND parcial_1.quimestre_p1 = '2do'
						AND parcial_1.anioInicio_p1 = '" . $anioI . "'
						AND parcial_1.anioFin_p1 = '" . $anioF . "'
						AND parcial_2.quimestre_p2 = '2do'
						AND parcial_2.anioInicio_p2 = '" . $anioI . "'
						AND parcial_2.anioFin_p2 = '" . $anioF . "'
						AND parcial_3.quimestre_p3 = '2do'
						AND parcial_3.anioInicio_p3 = '" . $anioI . "'
						AND parcial_3.anioFin_p3 = '" . $anioF . "'
						AND parcial_1.asignatura_p1 = '" . $materia . "'
						AND parcial_2.asignatura_p2 = '" . $materia . "'
						AND parcial_3.asignatura_p3 = '" . $materia . "'
						AND estudiante.id_estu = parcial_1.id_estu
						AND estudiante.id_estu = parcial_2.id_estu
						AND estudiante.id_estu = parcial_3.id_estu
						AND matricula.id_estu = estudiante.id_estu
						AND examen.id_estu = estudiante.id_estu
						AND examen.asignatura_exa = '" . $materia . "'
						AND examen.quimestre_exa = '2do'
						AND examen.anioInicio_exa = '" . $anioI . "'
						AND examen.anioFin_exa = '" . $anioF . "'
						AND examen_gracia.id_estu = estudiante.id_estu
						AND examen_gracia.anioInicio_gra = '" . $anioI . "'
						AND examen_gracia.anioFin_gra = '" . $anioF . "'
						AND examen_gracia.asignatura_gra = '" . $materia . "'
						) T2
						;");
			//return $result->row();
			return $result;
		}
		
		public function getNotasGraciaEdit($id = '')
		{
			$result = $this->db->query("SELECT * FROM examen_gracia WHERE id_gra = '" . $id . "'");
			//return $result->row();
			return $result;
		}
		
		public function updateGracia($notasEdit = '', $id = '')
		{
			if ($notasEdit != null) {
				$data = array(
					'nota_gra' 		=> $notasEdit['nota']
				);
				$this->db->where('id_gra', $id);
				return $this->db->update('examen_gracia', $data);
			}
			return false;
		}

	}

