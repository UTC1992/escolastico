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

		public function insertE($estudiante = null)
		{
			if ($estudiante != null) {
				$data = array(
					'cedula_estu' 					=> $estudiante['cedula_estu'],
					'nombres_estu' 					=> $estudiante['nombres_estu'],
					'apellidos_estu' 				=> $estudiante['apellidos_estu'],
					'fechanacimiento_estu'			=> $estudiante['fechanacimiento_estu'],
					'direccion_estu'				=> $estudiante['direccion_estu'],
					'lugar_nacimiento_estu'			=> $estudiante['lugar_nacimiento_estu'],
					'correo_estu'					=> $estudiante['correo_estu'],
					'telefono_estu'					=> $estudiante['telefono_estu'],
					'password_estu'					=> $estudiante['cedula_estu'],
					'representante_estu'			=> $estudiante['representante_estu'],
					'cedula_representante_estu'		=> $estudiante['cedula_representante_estu'],
					'telefono_representante_estu'	=> $estudiante['telefono_representante_estu'],
					'correo_repre_estu'				=> $estudiante['correo_repre_estu'],
					'nombre_padre_estu'				=> $estudiante['nombre_padre_estu'],
					'cedula_padre_estu'				=> $estudiante['cedula_padre_estu'],
					'telefono_padre_estu'			=> $estudiante['telefono_padre_estu'],
					'lugar_trabajo_p_estu'			=> $estudiante['lugartrabajo_p_estu'],
					'nombre_madre_estu'				=> $estudiante['nombre_madre_estu'],
					'cedula_madre_estu'				=> $estudiante['cedula_madre_estu'],
					'telefono_madre_estu'			=> $estudiante['telefono_madre_estu'],
					'lugar_trabajo_m_estu'			=> $estudiante['lugartrabajo_m_estu'],
					'discapacidad_sino_estu'		=> $estudiante['discapasidadSiNo_estu'],
					'nombre_disca_estu'				=> $estudiante['nombre_dis_estu'],
					'asociacion_disca_estu'			=> $estudiante['asociadoSiNo_estu']

				);
				return $this->db->insert('estudiante', $data);
			}
			return false;
		}

		public function getById($id = '')
		{
			$result = $this->db->query("SELECT * FROM estudiante WHERE id_estu = '" . $id . "'");
			//return $result->row();
			return $result;
		}

		public function updateE($estudiante = null, $id = '')
		{
			if ($estudiante != null) {
				$data = array(
					'cedula_estu' 					=> $estudiante['cedula_estu'],
					'nombres_estu' 					=> $estudiante['nombres_estu'],
					'apellidos_estu' 				=> $estudiante['apellidos_estu'],
					'fechanacimiento_estu'			=> $estudiante['fechanacimiento_estu'],
					'direccion_estu'				=> $estudiante['direccion_estu'],
					'lugar_nacimiento_estu'			=> $estudiante['lugar_nacimiento_estu'],
					'correo_estu'					=> $estudiante['correo_estu'],
					'telefono_estu'					=> $estudiante['telefono_estu'],
					'password_estu'					=> $estudiante['cedula_estu'],
					'representante_estu'			=> $estudiante['representante_estu'],
					'cedula_representante_estu'		=> $estudiante['cedula_representante_estu'],
					'telefono_representante_estu'	=> $estudiante['telefono_representante_estu'],
					'correo_repre_estu'				=> $estudiante['correo_repre_estu'],
					'nombre_padre_estu'				=> $estudiante['nombre_padre_estu'],
					'cedula_padre_estu'				=> $estudiante['cedula_padre_estu'],
					'telefono_padre_estu'			=> $estudiante['telefono_padre_estu'],
					'lugar_trabajo_p_estu'			=> $estudiante['lugartrabajo_p_estu'],
					'nombre_madre_estu'				=> $estudiante['nombre_madre_estu'],
					'cedula_madre_estu'				=> $estudiante['cedula_madre_estu'],
					'telefono_madre_estu'			=> $estudiante['telefono_madre_estu'],
					'lugar_trabajo_m_estu'			=> $estudiante['lugartrabajo_m_estu'],
					'discapacidad_sino_estu'		=> $estudiante['discapasidadSiNo_estu'],
					'nombre_disca_estu'				=> $estudiante['nombre_dis_estu'],
					'asociacion_disca_estu'			=> $estudiante['asociadoSiNo_estu']
				);
				$this->db->where('id_estu', $id);
				return $this->db->update('estudiante', $data);
			}
			return false;
		}

		public function getInicial($datosNivel = null)
		{
			$anioI = $datosNivel['fechainicio_matr'];
			$anioF = $datosNivel['fechafin_matr'];
			$nivel = $datosNivel['nivel_matr'];

			$result = $this->db->query("SELECT *
										FROM estudiante, matricula
										WHERE matricula.id_estu = estudiante.id_estu
										AND matricula.nivel_matr = '" . $nivel . "'
										AND matricula.fechainicio_matr LIKE '" . $anioI . "%'
										AND matricula.fechafin_matr LIKE '" . $anioF . "%'
										;");
			//return $result->row();
			return $result;
		}

		public function getIdEstudiante($cedula = '')
		{
			$result = $this->db->query("SELECT * FROM estudiante WHERE cedula_estu = '" . $cedula . "'");
			//return $result->row();
			return $result;
		}

    }
