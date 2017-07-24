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
												evaluacion_p1 as 'evaluacion',
												ROUND(((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1)/5), 2) as 'Promedio',
												comportamiento_p1 as 'comporta'
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
												evaluacion_p2 as 'evaluacion',
												ROUND(((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2)/5), 2) as 'Promedio',
												comportamiento_p2 as 'comporta'
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
												evaluacion_p3 as 'evaluacion',
												ROUND(((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3)/5), 2) as 'Promedio',
												comportamiento_p3 as 'comporta'
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

		public function getRepoNotasQuimestre($datos = null)
		{
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];
			$idCurso = $datos['idCurso'];
			$paralelo = $datos['paralelo'];
			$quimestre = $datos['quimestre'];
			$idEstu = $datos['idEstu'];

			$result = $this->db->query("SELECT
												asignatura_p1 as 'asignatura',
												ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'parcial1',
												ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'parcial2',
												ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'parcial3',
												nota_exa,
												ROUND
												(
													(
														( 
															(
																(
																	((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ) +
																	((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ) +
																	((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 )
																) / 3
															) * 0.8
														)
														+
														(
															nota_exa * 0.2
														)
													)
													, 2
												) as 'Promedio', 
												ROUND(
												((comportamiento_p1 + comportamiento_p2 + comportamiento_p3)/3)
												, 2) as 'comporta'
										
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

		public function getAsignaturasCurso($datos = null)
		{
			$idCurso = $datos['idCurso'];

			$result = $this->db->query("SELECT asignatura.nombre_asig as 'asig' FROM asignatura, curso, curso_asignatura
										WHERE
										asignatura.id_asig = curso_asignatura.id_asig
										AND
										curso.id_curs = curso_asignatura.id_curs
										AND
										curso.id_curs = '" . $idCurso . "'
										;");

			return $result;
		}
		
		public function getRepoNotasFinales($datos = null)
		{
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];
			$idCurso = $datos['idCurso'];
			$paralelo = $datos['paralelo'];
			$idEstu = $datos['idEstu'];
			
			if($datos['asignatura'] != ''){
				$asignatura = $datos['asignatura'];
			} else {
				$asignatura = '';
			}

			$result = $this->db->query("SELECT 	T1.asignatura, T1.Promedio as 'Q1', T2.Promedio as 'Q2',
												ROUND
												(
													(( T1.Promedio + T2.Promedio ) / 2) , 2
												)
												as 'promedioF',
												ROUND
												(
													(( T1.comporta + T2.comporta ) / 2) , 2
												)
												as 'comportaF'
										FROM
										(
											SELECT
													asignatura_p1 as 'asignatura',
													ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'parcial1',
													ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'parcial2',
													ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'parcial3',
													ROUND( ((comportamiento_p1 + comportamiento_p2 + comportamiento_p3) /3) , 2) as 'comporta',
													nota_exa,
													ROUND
													(
														(
															( 
																(
																	(
																		((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ) +
																		((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ) +
																		((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 )
																	) / 3
																) * 0.8
															)
															+
															(
																nota_exa * 0.2
															)
														)
														, 2
													) as 'Promedio'
													

											FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen
											WHERE estudiante.id_estu = '" . $idEstu . "'
											AND matricula.id_curs = '" . $idCurso . "'
											AND parcial_1.quimestre_p1 = '1ero'
											AND parcial_1.anioInicio_p1 = '" . $anioI . "'
											AND parcial_1.anioFin_p1 = '" . $anioF . "'
											AND parcial_2.quimestre_p2 = '1ero'
											AND parcial_2.anioInicio_p2 = '" . $anioI . "'
											AND parcial_2.anioFin_p2 = '" . $anioF . "'
											AND parcial_3.quimestre_p3 = '1ero'
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
											AND examen.quimestre_exa = '1ero'
											AND examen.anioInicio_exa = '" . $anioI . "'
											AND examen.anioFin_exa = '" . $anioF . "'
											AND examen.asignatura_exa = parcial_1.asignatura_p1
											AND examen.asignatura_exa = parcial_2.asignatura_p2
											AND examen.asignatura_exa = parcial_3.asignatura_p3
											AND examen.asignatura_exa = '" . $asignatura . "'
										) T1
										INNER JOIN 
										(
											SELECT
													asignatura_p1 as 'asignatura',
													ROUND( ((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ), 2) as 'parcial1',
													ROUND( ((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ), 2) as 'parcial2',
													ROUND( ((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 ), 2) as 'parcial3',
													ROUND( ((comportamiento_p1 + comportamiento_p2 + comportamiento_p3) /3) , 2) as 'comporta',
													nota_exa,
													ROUND
													(
														(
															( 
																(
																	(
																		((parametro1_p1 + parametro2_p1 + parametro3_p1 + parametro4_p1 + evaluacion_p1) / 5 ) +
																		((parametro1_p2 + parametro2_p2 + parametro3_p2 + parametro4_p2 + evaluacion_p2) / 5 ) +
																		((parametro1_p3 + parametro2_p3 + parametro3_p3 + parametro4_p3 + evaluacion_p3) / 5 )
																	) / 3
																) * 0.8
															)
															+
															(
																nota_exa * 0.2
															)
														)
														, 2
													) as 'Promedio'

											FROM estudiante, matricula, parcial_1, parcial_2, parcial_3, examen
											WHERE estudiante.id_estu = '" . $idEstu . "'
											AND matricula.id_curs = '" . $idCurso . "'
											AND parcial_1.quimestre_p1 = '2do'
											AND parcial_1.anioInicio_p1 = '" . $anioI . "'
											AND parcial_1.anioFin_p1 = '" . $anioF . "'
											AND parcial_2.quimestre_p2 = '2do'
											AND parcial_2.anioInicio_p2 = '" . $anioI . "'
											AND parcial_2.anioFin_p2 = '" . $anioF . "'
											AND parcial_3.quimestre_p3 = '2do'
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
											AND examen.quimestre_exa = '2do'
											AND examen.anioInicio_exa = '" . $anioI . "'
											AND examen.anioFin_exa = '" . $anioF . "'
											AND examen.asignatura_exa = parcial_1.asignatura_p1
											AND examen.asignatura_exa = parcial_2.asignatura_p2
											AND examen.asignatura_exa = parcial_3.asignatura_p3
											AND examen.asignatura_exa = '" . $asignatura . "'
										) T2
										;");

			return $result;
		}

		public function getDatosBoletin($datos = null)
		{
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];
			$idEstu = $datos['idEstu'];

			$result = $this->db->query("SELECT 
												estudiante.id_estu,
												id_matr,
												cedula_estu, 
												nombres_estu, 
												apellidos_estu, 
												nombre_curs, 
												paralelo_matr, 
												nivel_matr, 
												fechainicio_matr, 
												fechafin_matr

										FROM 
												estudiante, 
												matricula, 
												curso
										WHERE 
												estudiante.id_estu = matricula.id_estu AND 
												curso.id_curs = matricula.id_curs AND 
												matricula.fechainicio_matr LIKE '" . $anioI . "%' AND 
												matricula.fechafin_matr LIKE '" . $anioF . "%' AND 
												estudiante.id_estu = '" . $idEstu . "';	
			");
			//return $result->row();
			return $result;
		}

		public function getNotaSuple($datos = null)
		{
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];
			$idEstu = $datos['idEstu'];
			$asig = $datos['asignatura'];

			$result = $this->db->query("SELECT nota_suple
										FROM 
											examen_suple, estudiante
										WHERE
											estudiante.id_estu = examen_suple.id_estu
											AND examen_suple.anioinicio_suple = '" . $anioI . "'
											AND examen_suple.aniofin_suple = '" . $anioF . "'
											AND examen_suple.id_estu = '" . $idEstu . "'
											AND examen_suple.asignatura_suple = '" . $asig . "'
										;");

			return $result;
		}
		
		public function getNotaMejora($datos = null)
		{
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];
			$idEstu = $datos['idEstu'];
			$asig = $datos['asignatura'];

			$result = $this->db->query("SELECT nota_mejo
										FROM 
											examen_mejora, estudiante
										WHERE
											estudiante.id_estu = examen_mejora.id_estu
											AND examen_mejora.anioinicio_mejo = '" . $anioI . "'
											AND examen_mejora.aniofin_mejo = '" . $anioF . "'
											AND examen_mejora.id_estu = '" . $idEstu . "'
											AND examen_mejora.asignatura_mejo = '" . $asig . "'
										;");

			return $result;
		}

		public function getNotaRemedial($datos = null)
		{
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];
			$idEstu = $datos['idEstu'];
			$asig = $datos['asignatura'];

			$result = $this->db->query("SELECT nota_reme
										FROM 
											examen_remedial, estudiante
										WHERE
											estudiante.id_estu = examen_remedial.id_estu
											AND examen_remedial.anioinicio_reme = '" . $anioI . "'
											AND examen_remedial.aniofin_reme = '" . $anioF . "'
											AND examen_remedial.id_estu = '" . $idEstu . "'
											AND examen_remedial.asignatura_reme = '" . $asig . "'
										;");

			return $result;
		}
		
		public function getNotaGracia($datos = null)
		{
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];
			$idEstu = $datos['idEstu'];
			$asig = $datos['asignatura'];

			$result = $this->db->query("SELECT nota_gra
										FROM 
											examen_gracia, estudiante
										WHERE
											estudiante.id_estu = examen_gracia.id_estu
											AND examen_gracia.anioinicio_gra = '" . $anioI . "'
											AND examen_gracia.aniofin_gra = '" . $anioF . "'
											AND examen_gracia.id_estu = '" . $idEstu . "'
											AND examen_gracia.asignatura_gra = '" . $asig . "'
										;");

			return $result;
		}

	}


