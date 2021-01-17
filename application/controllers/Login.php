<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('AuthenticationModel');
        if($this->AuthenticationModel->isLoggedIn()){
            redirect('/');
        }
    }

    public function index(){
        $this->load->view('login');
    }
}