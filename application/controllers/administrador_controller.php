<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador_Controller extends CI_Controller 
{
	public function index()
	{
		//si no existe la sesion se redirige al login
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
		$data = array('title' => 'Administración');
		$this->load->view('/layout/head', $data);
		//$this->load->view('/layout/disenio_css_js');
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/administrador/content');
		$this->load->view('/layout/footer_base');
	}

    public function nuevo($error = "")
    {
		//se comprueba que la sesion exista y se redirecciona 
		//si existe va a la parte administrativa
		if ($this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/dashboard');
		}
        $data = array('title' => 'Registro Admin', 'error' => $error);
		$this->load->view('/layout/head', $data);
		//$this->load->view('/layout/disenio_css_js');
		$this->load->view('/layout/menuAdmin');
		$this->load->view('/administrador/nuevo');
		$this->load->view('/layout/footer_base');
    }

	public function insertar()
	{
		//se optiene los datos mediante el metodo POST
		$admin = $this->input->post();
		//se optiene el email para comprobar que sea unico
		$email = $this->input->post('email');
		if ($this->administrador_model->getAdmin($email) != null) {
			//si ya existe un admin con el mismo correo se envia un mensaje
			$this->nuevo("El correo ingresado ya esta siendo utilizado, intentar con otro correo.");
		} else {
			//se envian los datos del formulario al modelo al metodo insert
			$bool = $this->administrador_model->insert($admin);
			//se conprueba el registro correcto del registro
			if ($bool) {
				header("Location: " . base_url() . "login_admin/index");
			} else {
				header("Location: " . base_url() . "administrador_controller/nuevo");
			}
		}
	}
}
