<?php
	
	/**
	* 
	*/
	class Docente_Model extends CI_Model
	{
		public function getDocenteLogin($email = '')
		{
			$resutl = $this->db->query("SELECT * FROM docente WHERE email_doce = '" . $email . "'");
			
            if ($resutl->num_rows() > 0) {
				return $resutl->row();
			} else {
				return null;
			}
		}

		public function getDocente()
		{
			$result = $this->db->get('docente');
			return $result;
		}

		public function insertD($docente = null)
		{
			if ($docente != null) {
				$data = array(
					'cedula_doce' 							=> $docente['cedula_doce'],
					'nombres_doce' 							=> $docente['nombres_doce'],
					'apellidos_doce' 						=> $docente['apellidos_doce'],
					'fechanacimiento_doce'					=> $docente['fechanacimiento_doce'],
					'titulo_especializacion_senescyt_doce' 	=> $docente['titulo_especializacion_senescyt_doce'],
					'fecha_ingreso_magisterio_doce' 		=> $docente['fecha_ingreso_magisterio_doce'],
					'fecha_ingreso_institucion_doce' 		=> $docente['fecha_ingreso_institucion_doce'],
					'relacion_laboral_doce' 				=> $docente['relacion_laboral_doce'],
					'categoria_contrato_doce' 				=> $docente['categoria_contrato_doce'],
					'funcion_doce' 							=> $docente['funcion_doce'],
					'numero_horas_pedagogicas_doce' 		=> $docente['numero_horas_pedagogicas_doce'],
					'lugar_residencia_doce' 				=> $docente['lugar_residencia_doce'],
					'telefono_domicilio_doce' 				=> $docente['telefono_domicilio_doce'],
					'telefono_movil_doce' 					=> $docente['telefono_movil_doce'],
					'email_doce' 							=> $docente['email_doce'],
					'estado_doce' 							=> $docente['estado_doce']
				);
				return $this->db->insert('docente', $data);
			}
			return false;
		}

		public function getById($id = '')
		{
			$result = $this->db->query("SELECT * FROM docente WHERE id_doce = '" . $id . "'");
			//return $result->row();
			return $result;
		}

		public function updateD($docenteEdit = null, $id = '')
		{
			if ($docenteEdit != null && $id != '') {
				$data = array(
					'cedula_doce' 							=> $docenteEdit['cedula_doce'],
					'nombres_doce' 							=> $docenteEdit['nombres_doce'],
					'apellidos_doce' 						=> $docenteEdit['apellidos_doce'],
					'fechanacimiento_doce'					=> $docenteEdit['fechanacimiento_doce'],
					'titulo_especializacion_senescyt_doce' 	=> $docenteEdit['titulo_especializacion_senescyt_doce'],
					'fecha_ingreso_magisterio_doce' 		=> $docenteEdit['fecha_ingreso_magisterio_doce'],
					'fecha_ingreso_institucion_doce' 		=> $docenteEdit['fecha_ingreso_institucion_doce'],
					'relacion_laboral_doce' 				=> $docenteEdit['relacion_laboral_doce'],
					'categoria_contrato_doce' 				=> $docenteEdit['categoria_contrato_doce'],
					'funcion_doce' 							=> $docenteEdit['funcion_doce'],
					'numero_horas_pedagogicas_doce' 		=> $docenteEdit['numero_horas_pedagogicas_doce'],
					'lugar_residencia_doce' 				=> $docenteEdit['lugar_residencia_doce'],
					'telefono_domicilio_doce' 				=> $docenteEdit['telefono_domicilio_doce'],
					'telefono_movil_doce' 					=> $docenteEdit['telefono_movil_doce'],
					'email_doce' 							=> $docenteEdit['email_doce'],
					'estado_doce' 							=> $docenteEdit['estado_doce']
				);
				$this->db->where('id_doce', $id);
				return $this->db->update('docente', $data);
			}
			return false;
		}

		public function updateClave($docenteEdit = null, $id = '')
		{
			if ($docenteEdit != null && $id != '') {
				$data = array(
					'password_doce'		=> 		$docenteEdit['password_doce']
				);
				$this->db->where('id_doce', $id);
				return $this->db->update('docente', $data);
			}
			return false;
		}
    }
