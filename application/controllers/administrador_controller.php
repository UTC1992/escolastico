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
		if ($this->Administrador_Model->getAdmin($email) != null) {
			//si ya existe un admin con el mismo correo se envia un mensaje
			$this->nuevo("El correo ingresado ya esta siendo utilizado, intentar con otro correo.");
		} else {
			//se envian los datos del formulario al modelo al metodo insert
			$bool = $this->Administrador_Model->insert($admin);
			//se conprueba el registro correcto del registro
			if ($bool) {
				header("Location: " . base_url() . "login_admin/index");
			} else {
				header("Location: " . base_url() . "administrador_controller/nuevo");
			}
		}
	}

	public function perfil()
    {
		//se comprueba que la sesion exista y se redirecciona 
		//si existe va a la parte administrativa
		if (!$this->session->userdata('login_admin')) {
			header('Location:' . base_url() . 'admin_/login');
		}
        $data = array('title' => 'Perfil Admin');
		$this->load->view('/layout/head', $data);
		$this->load->view('/layout/menuAdmin');
		$idAdmin = $this->session->userdata('id_admin');
		$data = array('idAdmin' => $idAdmin);
		$this->load->view('/administrador/perfil', $data);
		$this->load->view('/layout/footer_base');
    }

	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonAdminId($id = "")
	{
		$json = new Services_JSON();

		$datos = array();

		$fila = $this->Administrador_Model->getAdminId($id);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosP = $json->encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosP;
	}

	public function actualizar($id = '')
	{
		//se optiene los datos mediante el metodo POST
		$adminEdit = $this->input->post();
		//se envian los datos del formulario al modelo al metodo insert
		$bool = $this->Administrador_Model->updateAdmin($adminEdit, $id);
		
	}

}
