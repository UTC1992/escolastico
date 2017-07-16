<?php
	
	/**
	* 
	*/
	class Matricula_Model extends CI_Model
	{
		public function getEstudiante($cedula = '')
		{
			$result = $this->db->query("SELECT * FROM estudiante WHERE cedula_estu = '" . $cedula . "'");
			//return $result->row();
			return $result;
		}

		public function insertM($matricula = null)
		{
			if ($matricula != null) {
				$data = array(
					'id_curs' 			=> $matricula['id_curs'],
					'id_estu' 			=> $matricula['id_estu'],
					'fechainicio_matr' 	=> $matricula['fechainicio_matr'],
					'fechafin_matr' 	=> $matricula['fechafin_matr'],
					'paralelo_matr' 	=> $matricula['paralelo_matr'],
					'nivel_matr' 		=> $matricula['nivel_matr']
				);
				return $this->db->insert('matricula', $data);
			}
			return false;
		}

		public function getCertificado($cedula = '', $AI = "", $AF = "")
		{
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
												matricula.fechainicio_matr LIKE '" . $AI . "%' AND 
												matricula.fechafin_matr LIKE '" . $AF . "%' AND 
												estudiante.cedula_estu = '" . $cedula . "';	
			");
			//return $result->row();
			return $result;
		}

		public function getCertificadoImprimir($idEstu = '', $fechaI = "", $fechaF = "")
		{
			$result = $this->db->query("SELECT 
												*
										FROM 
												estudiante, 
												matricula, 
												curso
										WHERE 
												estudiante.id_estu = matricula.id_estu AND 
												curso.id_curs = matricula.id_curs AND 
												matricula.fechainicio_matr = '" . $fechaI . "' AND 
												matricula.fechafin_matr LIKE '" . $fechaF . "' AND 
												estudiante.id_estu = '" . $idEstu . "';	
			");
			//return $result->row();
			return $result;
		}

		public function updateM($matricula = null, $id = '')
		{
			if ($matricula != null) {
				$data = array(
					'id_curs' 			=> $matricula['id_curs'],
					'fechainicio_matr' 	=> $matricula['fechainicio_matr'],
					'fechafin_matr' 	=> $matricula['fechafin_matr'],
					'paralelo_matr' 	=> $matricula['paralelo_matr'],
					'nivel_matr' 		=> $matricula['nivel_matr']
				);
				$this->db->where('id_matr', $id);
				return $this->db->update('matricula', $data);
			}
			return false;
		}

		public function getMatriculaActualizada($idMatri = "")
		{
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
												matricula.id_matr = '" . $idMatri . "' AND 
												estudiante.id_estu = matricula.id_estu;	
									");
			//return $result->row();
			return $result;
		}
    }
