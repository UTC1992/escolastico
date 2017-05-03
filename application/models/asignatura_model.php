<?php
	
	/**
	* 
	*/
	class Asignatura_Model extends CI_Model
	{
		public function getAsignatura()
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

    }
