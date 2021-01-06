<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Authentication extends \Restserver\Libraries\REST_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('AuthenticationModel');
    }

    public function authentication_post(){

        $email = $this->post('email');
        $password = $this->post('password');

        if($email == '' || $email == null || $password == '' || $password == null){
            $message = [
                'status' => FALSE,
                'message' => 'Unauthorized Accessed'
            ];
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_FORBIDDEN);
        }else{
            if($this->email_validation( $email)){
                if($this->AuthenticationModel->isLoggedIn()){
                    $message = [
                        'status' => FALSE,
                        'data' => "Already logged into the Application"
                    ];
                    $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
                }else{
                    $result = $this->AuthenticationModel->authenticateUser($email, $password);
                    if($result){
                        $message = [
                            'status' => TRUE,
                            'message' => "Successfully logged in"
                        ];
                        $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_OK);
                    }else{
                        $message = [
                            'status' => FALSE,
                            'message' => 'Please enter valid user name and Password'
                        ];
                        $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED);
                    }
                }

            }else{
                $message = [
                    'status' => FALSE,
                    'message' => 'You must enter valid email'
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED);
            }

        }
    }

    public function logout_post(){
        if(!$this->AuthenticationModel->isLoggedIn()) {
            $message = [
                'status' => FALSE,
                'message' => "You must login into the Application"
            ];
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if($this->AuthenticationModel->logout()){
                $message = [
                    'status' => TRUE,
                    'message' => "Successfully logout"
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
        }
    }

    private function email_validation($str) {
        return (!preg_match(
            "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str))
            ? FALSE : TRUE;
    }
}