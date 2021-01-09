<?php
defined('BASEPATH') or exit('No direct script access allowed');

/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

class WishItem extends \Restserver\Libraries\REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('AuthenticationModel');
        $this->load->model('WishItemModel');
        if (!$this->AuthenticationModel->isLoggedIn()) {
            redirect('Login');
        }
    }

    public function priority_get(){
        $result = $this->WishItemModel->getAllPriority();

        if (!empty($result)) {
            $this->set_response($result, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Priorities were not found'
            ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function item_get() {
        $id = $this->get('id');
        $userId = $this->session->userdata('userId');
        if ($id === NULL) {
            $results = $this->WishItemModel->getAllItems($userId);
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

    public function item_post() {
        $uId = $this->session->userdata('userId');
        $prId = $this->post('pr_id');
        $title = $this->post('title');
        $price = $this->post('price');
        $qty = $this->post('qty');
        $url = $this->post('url');
        $imgUrl = $this->post('img_url');

        if (!$this->isEmpty($prId) && !$this->isEmpty($title) &&
            !$this->isEmpty($price) && !$this->isEmpty($qty) && !$this->isEmpty($url)) {
            if(!$this->isImage($imgUrl)){
                $imgUrl = "assets/img/present.jpg";
            }

            $result = $this->WishItemModel->createItem($uId, $prId, $title, $price, $qty, $url, $imgUrl);
            if($result){
                $this->set_response($result[0], \Restserver\Libraries\REST_Controller::HTTP_CREATED);
            }else{
                $message = [
                    'status' => FALSE,
                    'message' => 'Item was not created. please try a again'
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $message = [
                'status' => FALSE,
                'message' => 'Please fill all fields'
            ];
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function item_put() {
        $id = $this->put('id');
        if($id === NULL){
            $message = [
                'status' => false,
                'message' => "Item id was required"
            ];
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }else{
            $imgUrl = $this->put('img_url');
            if(!$this->isImage($imgUrl)){
                $imgUrl = "assets/img/present.jpg";
            }
            $data = [
                'title' => $this->put('title'),
                'price' => $this->put('price'),
                'qty' => $this->put('qty'),
                'url' => $this->put('url'),
                'img_url' => $imgUrl,
                'updated_at' => date("Y-m-d h:m:s")
            ];
            $result = $this->WishItemModel->updateItem($id, $data);
            if ($result) {
                $this->set_response($result[0], \Restserver\Libraries\REST_Controller::HTTP_OK);
            } else {
                $message = [
                    'status' => false,
                    'message' => "Item was not found"
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function item_delete() {
        $id = (int)$this->get('id');

        if ($id <= 0 || $id === NULL) {
            // Set the response and exit
            $this->response(null, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }else{
            $result = $this->WishItemModel->deleteItem($id);
            if($result){
                $message = [
                    'id' => $result,
                    'message' => $id . ' Item deleted successfully'
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_ACCEPTED);
            }else{
                $message = [
                    'id' => $result,
                    'message' => 'Item was not found'
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    private function isEmpty($value) {
        return (!isset($value) || trim($value) === '');
    }

    function isImage($url) {
        return preg_match("/^[^\?]+\.(jpg|jpeg|gif|png)(?:\?|$)/", $url);
    }
}