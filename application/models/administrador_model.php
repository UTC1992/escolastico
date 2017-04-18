<?php
	
	/**
	* 
	*/
	class Administrador_Model extends CI_Model
	{
		public function getAdmin($email = '')
		{
			$resutl = $this->db->query("SELECT * FROM administrador WHERE correo_admin = '" . $email . "'");
			
            if ($resutl->num_rows() > 0) {
				return $resutl->row();
			} else {
				return null;
			}
		}

		public function insert($admin = null)
		{
			if ($admin != null) {
				$cedula = $admin['cedula'];
				$nombres = $admin['nombres'];
				$apellidos = $admin['apellidos'];
				$correo = $admin['email'];
				$password = $admin['password'];
				
				$SQL = "INSERT INTO administrador(cedula_admin, 
													nombres_admin, 
													apellidos_admin,
													correo_admin, 
													password_admin) 
				VALUES('$cedula', '$nombres', '$apellidos', '$correo', '$password');";

				if ($this->db->query($SQL)) {
					return true;
				}
			}
			return false;
		}	
	}
