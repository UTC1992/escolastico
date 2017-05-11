<?php
	
	/**
	* 
	*/
	class Docente_Model extends CI_Model
	{
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
					'estado_doce' 							=> $docente['estado_doce'],
				);
				return $this->db->insert('docente', $data);
			}
			return false;
		}
    }