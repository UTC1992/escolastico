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

		public function getAdminAll()
		{
			$resutl = $this->db->query("SELECT * FROM administrador;");
			
            if ($resutl->num_rows() > 0) {
				return $resutl->row();
			} else {
				return null;
			}
		}

		public function getAdminId($id = '')
		{
			$result = $this->db->query("SELECT * FROM administrador WHERE id_admin = '" . $id . "'");
			//return $result->row();
			return $result;
		}

		public function updateAdmin($adminEdit = null, $id = '')
		{
			if ($adminEdit != null && $id != '') {

				$data = array(
					'cedula_admin' 		=> $adminEdit['cedula_admin'],
					'nombres_admin' 	=> $adminEdit['nombres_admin'],
					'apellidos_admin' 	=> $adminEdit['apellidos_admin'],
					'correo_admin' 		=> $adminEdit['correo_admin'],
					'password_admin' 	=> $adminEdit['password_admin']
				);
				$this->db->where('id_admin', $id);
				return $this->db->update('administrador', $data);
			}
			return false;
		}
	}
