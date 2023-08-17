<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

	function check_user($username, $password) { 
		$password = hash('sha512', $password); 
		$this->db->select('*'); 
		$this->db->from('ACTIVOS_LOGIN'); 
		$this->db->where('NickName', $username); 
		$this->db->where('Password', $password); 
		$this->db->where('Estado', '1'); 
		$query = $this->db->get(); 
		return $query; 
	}

}
