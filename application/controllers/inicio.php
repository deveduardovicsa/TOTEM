<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	public function __construct() {
        parent:: __construct();
        $this->load->model('inicioModel');
    }

	public function index()
	{
		$this->load->view('inicio/inicioView');
	}

	public function auth()
	{
		$_SESSION['rut_cliente'] = $_POST['write'];
		$id = $_SESSION['rut_cliente'];
        unset($_SESSION['rut_cliente']);
		$result = $this->inicioModel->getData($id);

		if ($result > 0) {
            $data['result'] = $this->inicioModel->getData($id);
            //$this->load->view('inicio/menuClienteView', $data);
			redirect('inicio/menu');
        } else {
            echo "<script>alert('Ops! rut incorrecto! Rut : $id');history.go(-1);</script>";
        }

		//$this->load->view('inicio/menuClienteView',);
	}

	public function menu()
	{
		$this->load->view('inicio/menuClienteView');
	}
	
}