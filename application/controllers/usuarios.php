<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    public function __construct() {
        parent:: __construct();
        if($this->session->userdata('logged_in') !== TRUE) {
			redirect('Login');
		}
        $this->load->model('usuariosModel');
    }

	public function index() {
		$data['result'] = $this->usuariosModel->getAllData();
        $this->load->view('usuarios/usuariosView', $data);
    }

	// public function index() {
    //     $data['result'] = $this->usuariosModel->getAllData();
	// 	$this->load->view('usuarios/usuariosView', $data);
    // }

    public function nuevo() {
        $this->load->view('usuarios/usuariosNew');
    }

    public function create() {
        $this->usuariosModel->createData();
        redirect("Usuarios");
    }

    public function edit($id) {
        $data['row'] = $this->usuariosModel->getData($id);
        $this->load->view('usuarios/usuariosEdit', $data);
    }

    public function update($id) {
        $this->usuariosModel->updateData($id);
        redirect("Usuarios");
    }

    public function restablecer($id) {
        $this->usuariosModel->updatePass($id);
        $this->usuariosModel->getData($id);
        $this->send($id);
        redirect("Usuarios");
    }

    public function eliminar($id) {
        $this->usuariosModel->deleteData($id);
        redirect("Usuarios");
    }

    public function send($id){
        //Cargar Datos del usuario
        $row = $this->usuariosModel->getData($id);

        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'notificador@vicsa.cl';
        $mail->Password = 'Vicsa*317.';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;
        
        $mail->setFrom('notificador@vicsa.cl', 'Notificaciones');
        //$mail->addReplyTo('notificador@vicsa.cl', 'Notificaciones');
        
        // Add a recipient
        $mail->addAddress($row->Email);
        
        // Add cc or bcc 
        //$mail->addCC('edex770@gmail.com');
        //$mail->addBCC('bcc@example.com');
        
        // Email subject
        $nticket = $id_nticket;
        $mail->Subject = 'APRO - VICSA';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        // Para los tildes y eñes, deberíamos colocar:
        // á -> &aacute;
        // é -> &eacute;
        // í -> &iacute;
        // ó -> &oacute;
        // ú -> &uacute;
        // ñ -> &ntilde;

        $mailContent = '<h1>Estimado(a) '.$row->FirstName.' '.$row->LastName.' (Vicsa Safety),</h1>
            <p>Junto con saludar, le agradecemos por contactar al area de soporte de TI.
            Se ha generado un nuevo ticket a la espera de que un tecnico pueda responder su solicitud. Una vez su ticket haya sido respondido, sera notificado via mail.
            </p>';
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            redirect("Usuarios");
        }
    }
    
}
