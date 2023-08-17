<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class inicioModel extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    function createData() {
        $data = array (
            'UsuarioName' => $this->input->post('usuario_name'),
            'FirstName' => $this->input->post('first_name'),
            'LastName' => $this->input->post('last_name'),
            'Email' => $this->input->post('usuario_name'),
            'Perfil' => $this->input->post('perfil'),
            'Estado' => $this->input->post('usuario_estado')
        );
        $this->db->insert('INT_APRO_LOGIN', $data);
    }

    // function getAllData() {
    //     $query = $this->db->query('EXEC HD_LISTAR_A;');
    //     return $query->result();
    // }

    function getAllData() {
        $query = $this->db->query("EXEC SP_ACTIVOS_LISTAR_EQUIPO 'TODOS','';");
        return $query->result();
    }

    function getData($id) {
        $query = $this->db->query("SELECT DISTINCT CardCode,CardName,Rut, CardType FROM TOTEM_ACCESO_CLIENTES_VICSA WHERE CardType = 'C' and Rut ='.$id.'");
        return $query->result();
    }

    function updateData($id) {
        $usuario_name = $this->input->post('usuario_name');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $run = $this->input->post('run');
        $cargo = $this->input->post('cargo');
        $canal = $this->input->post('canal');
        $centro = $this->input->post('centro');
        $perfil = $this->input->post('perfil');
        $usuario_estado = $this->input->post('usuario_estado');
        
        $query = $this->db->query("EXEC SP_MUE_CRUD_USUARIOS 'MODIFICAR','$id','$usuario_name','','$perfil','$first_name','$last_name','$usuario_name','$usuario_estado','$run','$cargo','$canal','$centro';");
    }

    function updatePass($id) {
        $default = '1234';
        $password = hash('sha512', $default);
        $data = array (
            'UsuarioPass' => $password
        );
        $this->db->where('Id_usuario', $id);
        $this->db->update('INT_APRO_LOGIN', $data);
    }

    function deleteData($id) {
        $this->db->where('Id_usuario', $id);
        $this->db->delete('INT_APRO_LOGIN');
    }
}
