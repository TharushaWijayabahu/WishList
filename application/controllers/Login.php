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

//    function login(){
//        $this->form_validation->set_rules('user_email', 'Email Address',
//            'required|trim|valid_email');
//        $this->form_validation->set_rules('user_password', 'Password',
//            'required');
//
//        if($this->form_validation->run()){
//            $email = $this->input->post('user_email');
//            $password = $this->input->post('user_password');
//            $result = $this->AuthenticationModel->authenticateUser($email, $password);
//            if($result){
//                redirect('/');
//            }else{
//                $this->session->set_flashdata('message',$result);
//                redirect('login');
//            }
//        }else{
//            $this->index();
//        }
//
//    }

    function signUp(){

    }

    function registerUser(){
        $this->form_validation->set_rules('user_name', 'Name',
            'required|trim');
        $this->form_validation->set_rules('user_email', 'Email Address',
            'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('user_password', 'Password',
            'required');
        $this->form_validation->set_rules('user_address', 'Address',
            'required|trim');
        $this->form_validation->set_rules('user_mobile', 'Mobile Number',
            'required|trim');

        if($this->form_validation->run()) {
            $hashPassword = password_hash($this->input->post('user_password'), PASSWORD_DEFAULT);
            $data = array(
                'name' => $this->input->post('user_name'),
                'email' => $this->input->post('user_email'),
                'password' => $hashPassword,
                'address' => $this->input->post('user_address'),
                'tel' => $this->input->post('user_mobile'),
                'created_at' => date("Y-m-d h:m:s"),
                'updated_at' => date("Y-m-d h:m:s")
            );

            $result = $this ->AuthenticationModel->registerUser($data);
            if($result>0){
                $this->index();
            }
        }else{
            $this->index();
        }

    }

    function logout(){
        $data = $this->session->all_userdata();
        foreach ($data as $row => $value){
            $this->session->unset_userdata($row);
            $this->session->sess_destroy();
        }

        redirect('Authentication');
    }

    private function email_validation($str) {
        return (!preg_match(
            "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str))
            ? FALSE : TRUE;
    }

}