<?php
	
	/**
	* 
	*/
	class Docente_Cargo_Model extends CI_Model
	{
		public function getDocenteCargo()
		{
			$result = $this->db->get('cargo_docente_asignatura');
			return $result;
		}

		public function insertDC($docenteCargo = null)
		{
			if ($docenteCargo != null) {
				$data = array(
					'docente_cargo' 				=> $docenteCargo['docente_cargo'],
					'categoria_nivel_cargo' 		=> $docenteCargo['categoria_nivel_cargo'],
					'curso_cargo' 					=> $docenteCargo['curso_cargo'],
					'paralelo_cargo' 				=> $docenteCargo['paralelo_cargo'],
					'asignatura_cargo' 				=> $docenteCargo['asignatura_cargo'],
					'curso_completo_cargo' 			=> $docenteCargo['curso_completo_cargo'],
					'periodo_academico_cargo' 		=> $docenteCargo['periodo_academico_cargo'],
					'anioinicio_cargo' 				=> $docenteCargo['anioinicio_cargo'],
					'aniofin_cargo' 				=> $docenteCargo['aniofin_cargo']
				);
				return $this->db->insert('cargo_docente_asignatura', $data);
			}
			return false;
		}

		public function getDocenteCargoListar($idCurso = '', $idDoce = '', $idAsig = '', $idCargo = '')
		{
			$result = $this->db->query("SELECT * FROM cargo_docente_asignatura;");
			//return $result->row();
			return $result;
		}

		public function getById($id = '')
		{
			$result = $this->db->query("SELECT * FROM cargo_docente_asignatura WHERE id_cargo = '" . $id . "'");
			//return $result->row();
			return $result;
		}

		public function updateDC($docenteCargo = null, $id = '')
		{
			if ($docenteCargo != null) {
				$data = array(
					'docente_cargo' 				=> $docenteCargo['docente_cargo'],
					'categoria_nivel_cargo' 		=> $docenteCargo['categoria_nivel_cargo'],
					'curso_cargo' 					=> $docenteCargo['curso_cargo'],
					'paralelo_cargo' 				=> $docenteCargo['paralelo_cargo'],
					'asignatura_cargo' 				=> $docenteCargo['asignatura_cargo'],
					'curso_completo_cargo' 			=> $docenteCargo['curso_completo_cargo'],
					'periodo_academico_cargo' 		=> $docenteCargo['periodo_academico_cargo'],
					'anioinicio_cargo' 				=> $docenteCargo['anioinicio_cargo'],
					'aniofin_cargo' 				=> $docenteCargo['aniofin_cargo']
				);
				$this->db->where('id_cargo', $id);
				return $this->db->update('cargo_docente_asignatura', $data);
			}
			return false;
		}
		
		public function getDatosCargo($datos = null)
		{
			$docente = $datos['docente'];
			$anioI = $datos['anioI'];
			$anioF = $datos['anioF'];

			$result = $this->db->query("SELECT * 
										FROM cargo_docente_asignatura 
										WHERE 
										docente_cargo = '" . $docente . "'
										AND anioinicio_cargo = '" . $anioI . "'
										AND aniofin_cargo = '" . $anioF . "'
										;");
			
			return $result;
		}
    }
