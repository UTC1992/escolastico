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
    }