<?php
defined('BASEPATH') or exit('No direct script access allowed');

/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

class ShareListPublic extends \Restserver\Libraries\REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ShareListModel');
    }

    public function list_get() {
        $id = $this->get('id');

        if ($id === NULL || $id === "") {
            $this->response([
                'status' => FALSE,
                'message' => 'Request not Allowed'
            ], \Restserver\Libraries\REST_Controller::HTTP_METHOD_NOT_ALLOWED); // NOT_FOUND (404) being the HTTP response code

        } else {
            $result = $this->ShareListModel->getSharedList($id);
            if ($result === 'private') {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Link not found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            } else if ($result) {
                $this->set_response($result, \Restserver\Libraries\REST_Controller::HTTP_OK);
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Link not found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function wishlist_get() {

        $id = $this->get('id');

        if ($id === NULL || $id === "") {
            $this->response([
                'status' => FALSE,
                'message' => 'Request not Allowed'
            ], \Restserver\Libraries\REST_Controller::HTTP_METHOD_NOT_ALLOWED); // NOT_FOUND (404) being the HTTP response code

        } else {
            $result = $this->ShareListModel->getSharedWishList($id);
            if ($result === 'private') {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Link not found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            } else if ($result) {
                $this->set_response($result[0], \Restserver\Libraries\REST_Controller::HTTP_OK);
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Link not found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function user_get() {

        $id = $this->get('id');

        if ($id === NULL || $id === "") {
            $this->response([
                'status' => FALSE,
                'message' => 'Request not Allowed'
            ], \Restserver\Libraries\REST_Controller::HTTP_METHOD_NOT_ALLOWED); // NOT_FOUND (404) being the HTTP response code

        } else {
            $result = $this->ShareListModel->getSharedUser($id);
            if ($result === 'private') {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Link not found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            } else if ($result) {
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