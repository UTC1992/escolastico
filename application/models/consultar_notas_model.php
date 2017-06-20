<?php
	
	/**
	* 
	*/
	class Consultar_Notas_Model extends CI_Model
	{
		public function getEstuLogin($username = '')
		{
			$result = $this->db->query("SELECT * FROM estudiante WHERE cedula_estu = '" . $username . "'");
			
			if ($result->num_rows() > 0) {
				return $result->row();
			} else {
				return null;
			}
		}
	}
