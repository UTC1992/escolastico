<?php 
	
	/**
	* 
	*/
	class Login_Estu extends CI_Controller
	{
		public function index($error = '')
        {
			if ($this->session->userdata('login_estu')) {
				header('Location:' . base_url() . 'notas_/consultar/notas/index/');
			}
            $data = array('title' => 'Login Estudiante');
		    $this->load->view('/layout/head', $data);
            $this->load->view('/layout/disenio_css_js');
			if ($error != '') {
				$data = array('error' => $error);
				$this->load->view('/layout/menuIngresoNotas', $data);
			} else {
				$data = array('error' => '');
				$this->load->view('/layout/menuIngresoNotas', $data);
			}
			
            $this->load->view('/consultas_estudiante/login');
			$this->load->view('/layout/footer');
        }

		public function login()
		{
			$username 	= $this->input->post('username');
			$password  	= $this->input->post('password');

			$this->load->model('consultar_notas_model');
			$fila = $this->consultar_notas_model->getEstuLogin($username);

			if ($fila != null) {
				if ($fila->password_estu == $password) {
					$data = array(
							'cedula' 		=>  $fila->cedula_estu,
							'id_estu' 		=>  $fila->id_estu,
							'tipo_admin' 	=>	'estudiante',
							'login_estu'	=> 	true
							);
					$this->session->set_userdata($data);
                    //login exitoso
					header("Location:" . base_url() . "notas_/consultar/notas/index/");
				} else {
                    //contraseña incorrecta
					$error = 'Usuario o contraseña incorrectos';
					$this->index($error);
				}
			} else {
                //email incorrecto
				$error = 'Usuario o contraseña incorrectos';
				$this->index($error);
			}
		}

		public function logout()
		{   
            //cerrar sesion
			$this->session->sess_destroy();
			header('Location:' . base_url() . "notas_/consultar/notas/login");
		}		
	}
