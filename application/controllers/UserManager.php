<?php


class UserManager extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AuthenticationModel');
        if(!$this->AuthenticationModel->isLoggedIn()){
            redirect('Login');
        }
    }

    function index() {

        $this->load->view('wishlist');
    }
}