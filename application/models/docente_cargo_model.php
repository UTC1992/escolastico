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

		public function insertDC($docenteC = null)
		{
			if ($docenteC != null) {
				$data = array(
					'id_doce' => $docenteC['id_doce'],
					'categoria_nivel_cargo' => $docenteC['categoria_nivel_cargo'],
					'id_curs' => $docenteC['id_curs'],
					'paralelo_cargo' => $docenteC['paralelo_cargo'],
					'id_asig' => $docenteC['id_asig'],
					'curso_completo_cargo' => $docenteC['curso_completo_cargo'],
					'periodo_academico_cargo' => $docenteC['periodo_academico_cargo']
				);
				return $this->db->insert('cargo_docente_asignatura', $data);
			}
			return false;
		}

		public function getDocenteCargoListar($idCurso = '', $idDoce = '', $idAsig = '', $idCargo = '')
		{
			$result = $this->db->query("SELECT 	
												id_cargo,
												cedula_doce,
												nombres_doce,
												apellidos_doce, 
												categoria_nivel_cargo, 
												nombre_curs, paralelo_cargo, 
												nombre_asig, 
												curso_completo_cargo,
												periodo_academico_cargo
										FROM 
												curso, 
												docente, 
												asignatura, 
												cargo_docente_asignatura 
										WHERE
											curso.id_curs = cargo_docente_asignatura.id_curs 
											and asignatura.id_asig = cargo_docente_asignatura.id_asig
											and docente.id_doce = cargo_docente_asignatura.id_doce
											and	cargo_docente_asignatura.id_curs = '" . $idCurso . "' 
											and cargo_docente_asignatura.id_asig = '" . $idAsig . "'
											and cargo_docente_asignatura.id_doce = '" . $idDoce . "'
											and cargo_docente_asignatura.id_cargo = '" . $idCargo . "';
											");
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
					'id_doce' => $docenteCargo['id_doce'],
					'categoria_nivel_cargo' => $docenteCargo['categoria_nivel_cargo'],
					'id_curs' => $docenteCargo['id_curs'],
					'paralelo_cargo' => $docenteCargo['paralelo_cargo'],
					'id_asig' => $docenteCargo['id_asig'],
					'curso_completo_cargo' => $docenteCargo['curso_completo_cargo'],
					'periodo_academico_cargo' => $docenteCargo['periodo_academico_cargo']
				);
				$this->db->where('id_cargo', $id);
				return $this->db->update('cargo_docente_asignatura', $data);
			}
			return false;
		}
    }