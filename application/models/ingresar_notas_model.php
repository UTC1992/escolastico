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

		public function insertN($notas = null)
		{
			if ($notas != null) {
				$data = array(
					'parametro1_p1' 					=> $notas['parametro1_p1'],
					'parametro2_p1' 					=> $notas['parametro2_p1'],
					'parametro3_p1' 					=> $notas['parametro3_p1'],
					'parametro4_p1' 					=> $notas['parametro4_p1'],
					'quimestre_p1' 						=> $notas['quimestre_p1'],
					'asignatura_p1' 					=> $notas['asignatura_p1'],
					'anioInicio_p1' 					=> $notas['anioInicio_p1'],
					'anioFin_p1' 						=> $notas['anioFin_p1'],
					'id_estu' 							=> $notas['id_estu']

				);
				return $this->db->insert('parcial_1', $data);
			}
			return false;
		}

	}

