<?php 
	
	/**
	* 
	*/
	class Login_Docente extends CI_Controller
	{
		public function index($error = '')
        {
			if ($this->session->userdata('login_doce')) {
				header('Location:' . base_url() . 'notas_/ingresar_notas/index/');
			}
            $data = array('title' => 'Login Admin');
		    $this->load->view('/layout/head', $data);
            $this->load->view('/layout/disenio_css_js');
			$this->load->view('/layout/menuIngresoNotas');
			if ($error != '') {
				$data = array('error' => $error);
				$this->load->view('/ingreso_notas/login', $data);
			} else {
				$data = array('error' => '');
				$this->load->view('/ingreso_notas/login', $data);
			}
            
			$this->load->view('/layout/footer');
        }

		public function login()
		{
			$email  	= $this->input->post('email');
			$password  	= $this->input->post('password');

			$this->load->model('docente_model');
			$fila = $this->docente_model->getDocenteLogin($email);

			if ($fila != null) {
				if ($fila->password_doce == $password) {
					$data = array(
							'email' 		=>  $email ,
							'id_doce' 			=>  $fila->id_doce,
							'nombreApellido_doce' 	=>  $fila->nombres_doce . " " . $fila->apellidos_doce,
							'docenteCargo_doce' 	=>  $fila->apellidos_doce . " " . $fila->nombres_doce,
							'tipo_admin' 	=>	'docente',
							'login_doce'	=> 	true
							);
					$this->session->set_userdata($data);
                    //login exitoso
					header("Location:" . base_url() . "notas_/ingresar_notas/index/");
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
			header('Location:' . base_url() . "notas_/ingresar_notas/login");
		}		
	}
