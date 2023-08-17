<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('loginModel');
	}

	public function index()
	{
		$this->load->view('login/loginView');
	}

	function auth() {
		$username  = $this->input->post('username',TRUE);
		$password  = $this->input->post('password',TRUE);
		$result    = $this->loginModel->check_user($username, $password);
		if($result->num_rows() > 0) {
			$data  = $result->row_array();
			$id_user = $data['Id'];
			$firstname  = $data['Nombres'];
			$lastname  = $data['Apellidos'];
			$email = $data['Email'];
			$level = $data['Id_Perfil'];
			$estado = $data['Estado'];
			$cargo = $data['Cargo'];
			$sesdata = array(
				'id_user'      => $id_user,
				'username'     => $username,
				'firstname'    => $firstname,
				'lastname'     => $lastname,
				'email'		   => $email,
				'level'        => $level,
				'pass'         => $password,
				'status'       => $estado,
				'cargo'        => $cargo,
				'logged_in'    => TRUE
			);
			$this->session->set_userdata($sesdata);
			// if($level === '1') {
			// 	redirect('superadmin');
			// } elseif($level === '2') {
			// 	redirect('admin');
			// } elseif($level === '3') {
			// 	redirect('avanzado');
			// } elseif{
			// 	redirect('basico');
			// }
			if($estado === 'Inactivo') {
				$this->load->view('basico/inactivo');
			}else{
				if($level === 1) {
					redirect('inicio');
				} elseif($level === '2') {
					redirect('inicio');
				} elseif($level === '3') {
					redirect('inicio');
				} elseif($level === '4'){
					redirect('inicio');
				}
			}
		} else {
			echo "<script>alert('access denied');history.go(-1);</script>";
		}
		//$this->load->view('login_view');
	}

	function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}
}
