<?php
	
	/**
	* 
	*/
	class Periodoa_Model extends CI_Model
	{
		public function getPeriodoAcademico()
		{
			return $this->db->get('periodo_academico');
		}
    }