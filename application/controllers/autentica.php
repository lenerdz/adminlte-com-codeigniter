<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentica extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('model_usuario',TRUE);
        $this->load->helper('url');
    } 

    function index() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_message('required', 'Campo %s obrigatório.');
        $this->form_validation->set_rules('email', 'Email ou Usuário', 'trim|required');
    
        $this->form_validation->set_message('check_database', 'Campo %s obrigatório.');
        $this->form_validation->set_rules('password', 'Senha', 'trim|required|callback_check_database');
        

        if($this->form_validation->run() == FALSE){
            $this->load->view('view_login');
        } else {
            redirect('home/dashboard', 'refresh');
        }
    }

    function check_database($senha) {
        $login = $this->input->post('email');
        $result = $this->model_usuario->login($login, $senha);
        $usuarioid = '';
        $usuarionome = '';
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}