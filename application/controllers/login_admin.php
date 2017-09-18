<?php 
	
	/**
	* 
	*/
	class Login_Admin extends CI_Controller
	{
		public function index($error = '')
        {
			if ($this->session->userdata('login_admin')) {
				header('Location:' . base_url() . 'admin_/dashboard');
			}
            $data = array('title' => 'Login Admin');
		    $this->load->view('/layout/head', $data);
            $this->load->view('/layout/disenio_css_js');
			$this->load->view('/layout/menuAdmin');
			if ($error != '') {
				$data = array('error' => $error);
				$this->load->view('/loginAdmin/content', $data);
			} else {
				$data = array('error' => '');
				$this->load->view('/loginAdmin/content', $data);
			}
			$this->load->view('/layout/footer');
        }

		public function login()
		{
			$email  	= $this->input->post('email');
			$password  	= $this->input->post('password');

			$this->load->model('Administrador_Model');
			$fila = $this->Administrador_Model->getAdmin($email);

			if ($fila != null) {
				if ($fila->password_admin == $password) {
					$data = array(
							'email_admin' 		=>  $email ,
							'id_admin' 			=>  $fila->id_admin,
							'tipo_admin' 	=>	$fila->tipo_admin,
							'login_admin'	=> 	true
							);
					$this->session->set_userdata($data);
                    //login exitoso
					header("Location:" . base_url() . "admin_/dashboard");
				} else {
                    //contraseña incorrecta
					$error = 'E-mail o contraseña incorrectos';
					$this->index($error);
				}
			} else {
                //email incorrecto
				$error = 'E-mail o contraseña incorrectos';
				$this->index($error);
			}
		}

		public function logout()
		{   
            //cerrar sesion
			$this->session->sess_destroy();
			header('Location:' . base_url() . "admin_/login");
		}		
	}
