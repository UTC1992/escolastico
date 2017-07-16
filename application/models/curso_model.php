<?php
	
	/**
	* 
	*/
	class Curso_Model extends CI_Model
	{
		public function getCurso()
		{
			$result = $this->db->get('curso');
			return $result;
		}

		public function insertC($curso = null)
		{
			if ($curso != null) {
				$data = array(
					'nombre_curs' => $curso['nombre_curs'],
					'nivel_curs' => $curso['nivel_curs']
				);
				return $this->db->insert('curso', $data);
			}
			return false;
		}

		public function getById($id = '')
		{
			$result = $this->db->query("SELECT * FROM curso WHERE id_curs = '" . $id . "'");
			//return $result->row();
			return $result;
		}

		public function updateC($cursoEdit = null, $id = '')
		{
			if ($cursoEdit != null && $id != '') {

				$data = array(
					'nombre_curs' => $cursoEdit['nombre_curs'],
					'nivel_curs' => $cursoEdit['nivel_curs']
				);
				$this->db->where('id_curs', $id);
				return $this->db->update('curso', $data);
			}
			return false;
		}

    }
