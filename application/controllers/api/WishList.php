<?php
defined('BASEPATH') or exit('No direct script access allowed');

/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

class WishList extends \Restserver\Libraries\REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AuthenticationModel');
        $this->load->model('WishListModel');
        if (!$this->AuthenticationModel->isLoggedIn()) {
            redirect('Login');
        }
    }

    public function wishlist_post() {
        $name = $this->post('name');
        $occasion = $this->post('occasion');
        $description = $this->post('description');

        if (!$this->isEmpty($name) && !$this->isEmpty($occasion) && !$this->isEmpty($description)) {
            $data = [
                'u_id' => $this->session->userdata('userId'),
                'name' => $name,
                'occasion' => $occasion,
                'description' => $description,
                'created_at' => date("Y-m-d h:m:s"),
                'updated_at' => date("Y-m-d h:m:s")
            ];
            $result = $this->WishListModel->createWishList($data);
            if ($result) {
                $this->set_response($result, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
            } else {
                $message = [
                    'status' => FALSE,
                    'message' => 'Wish list was not created. please try a again'
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $message = [
                'status' => FALSE,
                'message' => 'Please fill all the field'
            ];
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function wishlist_get() {
        $id = $this->get('id');
        $userId = $this->session->userdata('userId');

        if ($id === NULL) {
            $result = $this->WishListModel->getAllWishList($userId);
            if ($result) {
                // Set the response and exit
                $this->response($result, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No wish lists were found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $id = (int)$id;
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            $result = $this->WishListModel->getWishListById($userId, $id);
            if (!empty($result)) {
                $this->set_response($result, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Wishlist was not found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

    public function wishlist_delete() {

        $id = (int)$this->get('id');
        var_dump($id . "delete called");
        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(NULL, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];
        $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function wishlist_put() {
        $id = $this->put('id');
        $data = [
            'name' => $this->put('name'),
            'occasion' => $this->put('occasion'),
            'description' => $this->put('description'),
            'updated_at' => date("Y-m-d h:m:s")
        ];
        $result = $this->WishListModel->updateWishList($id, $data);
        if ($result) {
            $this->set_response($result, \Restserver\Libraries\REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code
        } else {
            $message = [
                'status' => false,
                'message' => "Wish List were not found"
            ];
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function priority_get(){
            $result = $this->WishListModel->getAllPriority();

            if (!empty($result)) {
                $this->set_response($result, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Priorities were not found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
    }

    public function items_get() {
        $id = $this->get('id');
        $userId = $this->session->userdata('userId');
        $wishListId = $this->get('wId');
        if ($id === NULL) {
                $results = $this->WishListModel->getAllItems($userId, $wishListId);
            if ($results) {
                // Set the response and exit
                $this->response($results, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No items were found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $id = (int)$id;
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            $item = null;
            if (!empty($item)) {

                $this->set_response($item, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Item could not be found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }

    public function items_post() {

    }

    public function items_put() {

        $data = $this->put('');

    }

    public function items_delete() {
        $id = (int)$this->get('id');

    }

    private function isEmpty($value) {
        return (!isset($value) || trim($value) === '');
    }

}