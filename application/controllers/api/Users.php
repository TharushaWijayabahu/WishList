<?php

defined('BASEPATH') or exit('No direct script access allowed');

/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

class Users extends \Restserver\Libraries\REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AuthenticationModel');
        $this->load->model('UserModel');
    }

    public function user_get() {
        $id = $this->get('id');

        if ($id === NULL || $id === "") {
            $this->response([
                'status' => FALSE,
                'message' => 'Request not Allowed'
            ], \Restserver\Libraries\REST_Controller::HTTP_METHOD_NOT_ALLOWED); // NOT_FOUND (404) being the HTTP response code

        } // Find and return a single record for a particular user.
        else {
            $id = (int)$id;

            if ($id <= 0) {
                $this->response(NULL, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            } else {
                $result = $this->UserModel->getUser($id);

                if (!empty($result)) {
                    $this->set_response($result[0], \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'User not found'
                    ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }
        }
    }

    public function user_post() {
        $name = $this->post('name_reg');
        $email = $this->post('email_reg');
        $password = $this->post('password_reg');
        $address = $this->post('address_reg');
        $mobile = $this->post('mobile_reg');

        if ($name == '' || $email == '' || $address == '' || $password == '' || $mobile == '') {
            $message = [
                'status' => FALSE,
                'message' => 'Unauthorized Accessed'
            ];
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_FORBIDDEN);
        } else {
            if ($this->email_validation($email)) {
                $result = $this->UserModel->registerUser($name, $email, $password, $address, $mobile);

                if ($result) {
                    $message = [
                        'status' => TRUE,
                        'message' => 'Successfully Registered. You can sign in using the link below.'
                    ];
                    $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
                } else {
                    $message = [
                        'status' => FALSE,
                        'message' => 'This email is already registered. Please log in.'
                    ];
                    $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
                }
            } else {
                $message = [
                    'status' => FALSE,
                    'message' => 'You must enter valid email'
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
    }

    public function user_put() {
        $id = $this->put('id');
        $id = $this->put('id');
        if ($id === NULL) {
            $message = [
                'status' => false,
                'message' => "User id was required"
            ];
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $data = [
                'name' => $this->put('name'),
                'email' => $this->put('email'),
                'address' => $this->put('address'),
                'tel' => $this->put('tel'),
                'updated_at' => date("Y-m-d h:m:s")
            ];

            $result = $this->UserModel->updateUser($id, $data);
            if ($result) {
                $this->set_response($result[0], \Restserver\Libraries\REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code
            } else {
                $message = [
                    'status' => false,
                    'message' => "User not found"
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
    }

    private function email_validation($str) {
        return (!preg_match(
            "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str))
            ? FALSE : TRUE;
    }

}