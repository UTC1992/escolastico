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

		public function getMatricula($datos = '')
		{
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];
			$idEstu = $datos['idEstu'];

			$result = $this->db->query("SELECT * 
										FROM matricula 
										WHERE matricula.id_estu = '" . $idEstu . "' 
										AND matricula.fechainicio_matr LIKE '" . $anioI . "%' 
										AND matricula.fechafin_matr LIKE '" . $anioF . "%'
										");
			
			return $result;
		}
	}
