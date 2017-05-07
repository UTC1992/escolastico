<?php
	
	/**
	* 
	*/
	class Asignatura_Model extends CI_Model
	{
		public function getAsignaturas()
		{
			$result = $this->db->get('asignatura');
			return $result;
		}

		public function insertA($asignatura = null)
		{
			if ($asignatura != null) {
				$data = array(
					'nombre_asig' => $asignatura['nombre_asig']
				);
				return $this->db->insert('asignatura', $data);
			}
			return false;
		}

		public function getById($id = '')
		{
			$result = $this->db->query("SELECT * FROM asignatura WHERE id_asig = '" . $id . "'");
			//return $result->row();
			return $result;
		}

		public function updateA($asigEdit = null, $id = '')
		{
			if ($asigEdit != null && $id != '') {

				$data = array(
					'nombre_asig' => $asigEdit['nombre_asig'],
				);
				$this->db->where('id_asig', $id);
				return $this->db->update('asignatura', $data);
			}
			return false;
		}

    }
