<?php
defined('BASEPATH') or exit('No direct script access allowed');

/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

class ShareLink extends \Restserver\Libraries\REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('AuthenticationModel');
        $this->load->model('ShareListModel');
        if (!$this->AuthenticationModel->isLoggedIn()) {
            redirect('Login');
        }
    }

    public function link_post() {
        $uID = $this->session->userdata('userId');
        $wID = $this->post('w_id');
        $isShared = $this->post('is_shared');

        if (!$this->isEmpty($uID) && !$this->isEmpty($wID) && !$this->isEmpty($isShared)) {
            $result = $this->ShareListModel->shareLink($uID, $wID, $isShared);
            if ($result) {
                $this->set_response($result[0], \Restserver\Libraries\REST_Controller::HTTP_CREATED);
            } else {
                $message = [
                    'status' => FALSE,
                    'message' => 'Link was not created. please try a again'
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $message = [
                'status' => FALSE,
                'message' => 'Please fill all fields'
            ];
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function link_put() {
        $id = $this->put('id');
        if ($id === NULL) {
            $message = [
                'status' => false,
                'message' => "Link id was required"
            ];
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $isShared = $this->put('is_shared');
            $result = $this->ShareListModel->updateLink($id, $isShared);

            if ($result) {
                $this->set_response($result[0], \Restserver\Libraries\REST_Controller::HTTP_OK);
            } else {
                $message = [
                    'status' => false,
                    'message' => "Link was not found"
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function link_get(){
        $userId = $this->get('user_id');

        if ($userId === NULL || $userId === "") {
            $this->response([
                'status' => FALSE,
                'message' => 'Request not Allowed'
            ], \Restserver\Libraries\REST_Controller::HTTP_METHOD_NOT_ALLOWED); // NOT_FOUND (404) being the HTTP response code

        }
        else {
            $userId = (int)$userId;

            if ($userId <= 0) {
                $this->response(NULL, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $result = $this->ShareListModel->getLink($userId);
                if (!empty($result)) {
                    $this->set_response($result[0], \Restserver\Libraries\REST_Controller::HTTP_OK);
                } else {
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'Link not found'
                    ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
                }
            }
        }
    }

    public function link_delete(){
        $id = (int)$this->get('id');
        if ($id <= 0 || $id === NULL) {
            // Set the response and exit
            $this->response(null, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }else{
            $result = $this->ShareListModel->deleteLink($id);
            if($result){
                $message = [
                    'id' => $result,
                    'message' => 'Link deleted successfully'
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_ACCEPTED);
            }else{
                $message = [
                    'id' => $result,
                    'message' => 'Link was not found'
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    private function isEmpty($value) {
        return (!isset($value) || trim($value) === '');
    }

}