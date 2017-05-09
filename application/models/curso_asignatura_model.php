<?php
	
	/**
	* 
	*/
	class Curso_Asignatura_Model extends CI_Model
	{
		public function insertAC($asigCurso = null)
		{
			if ($asigCurso != null) {
				$data = array(
					'id_curs' => $asigCurso['id_curs'],
					'id_asig' => $asigCurso['id_asig']
				);
				return $this->db->insert('curso_asignatura', $data);
			}
			return false;
		}

		public function getAsignaturasByCurso($id = '')
		{
			$result = $this->db->query("SELECT 
											id_cura, nombre_asig 
										from 
											curso, curso_asignatura, asignatura 
										WHERE
											curso.id_curs = curso_asignatura.id_curs 
											and asignatura.id_asig = curso_asignatura.id_asig
											and curso_asignatura.id_curs = '" . $id . "'
										");
			//return $result->row();
			return $result;
		}

		public function deleteAC($id = '')
		{
			$this->db->where("id_cura", $id);
			$result = $this->db->delete('curso_asignatura');
			//return $result->row();
			return $result;
		}


    }

	//SELECT nombre_asig from curso, curso_asignatura, asignatura WHERE 
	//curso.id_curs = curso_asignatura.id_curs and asignatura.id_asig = curso_asignatura.id_asig 
	//and curso_asignatura.id_curs = 667;