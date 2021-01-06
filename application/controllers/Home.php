<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AuthenticationModel');
        if(!$this->AuthenticationModel->isLoggedIn()){
            redirect('Login');
        }
    }

    public function index(){
        $this->load->view('wishlist');
    }

}