<?php
	
	/**
	* 
	*/
	class Estudiante_Model extends CI_Model
	{
		public function getEstudiante()
		{
			$result = $this->db->get('estudiante');
			return $result;
		}
    }