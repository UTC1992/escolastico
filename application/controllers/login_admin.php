<?php 
	
	/**
	* 
	*/
	class Login_Admin extends CI_Controller
	{
		public function index()
        {
			if ($this->session->userdata('login_admin')) {
				header('Location:' . base_url() . 'admin_/dashboard');
			}
            $data = array('title' => 'Login Admin');
		    $this->load->view('/layout/head', $data);
            $this->load->view('/layout/disenio_css_js');
			$this->load->view('/layout/menuAdmin');
            $this->load->view('/loginAdmin/content');
			$this->load->view('/layout/footer');
        }

		public function login()
		{
			$email  	= $this->input->post('email');
			$password  	= $this->input->post('password');

			$this->load->model('administrador_model');
			$fila = $this->administrador_model->getAdmin($email);

			if ($fila != null) {
				if ($fila->password_admin == $password) {
					$data = array(
							'email' =>  $email ,
							'id' 	=>  $fila->id,
							'login_admin'	=> true
							);
					$this->session->set_userdata($data);
                    //login exitoso
					header("Location:" . base_url() . "admin_/dashboard");
				} else {
                    //contraseña incorrecta
					header("Location:" . base_url() . "admin_/login");
				}
			} else {
                //email incorrecto
				header("Location:" . base_url() . "admin_/login");
			}
		}

		public function logout()
		{   
            //cerrar sesion
			$this->session->sess_destroy();
			header('Location:' . base_url() . "admin_/login");
		}		
	}
