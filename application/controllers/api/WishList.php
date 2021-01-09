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
        $imgUrl = $this->post('img_url');

        if (!$this->isEmpty($name) && !$this->isEmpty($occasion) && !$this->isEmpty($description)) {
            if(!$this->isImage($imgUrl)){
                $imgUrl = "assets/img/wishlist.png";
            }
            $data = [
                'u_id' => $this->session->userdata('userId'),
                'name' => $name,
                'occasion' => $occasion,
                'description' => $description,
                'img_url' => $imgUrl,
                'created_at' => date("Y-m-d h:m:s"),
                'updated_at' => date("Y-m-d h:m:s")
            ];
            $result = $this->WishListModel->createWishList($data);
            if ($result) {
                $this->set_response($result[0], \Restserver\Libraries\REST_Controller::HTTP_CREATED);
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
                $this->response($result[0], \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
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
                $this->set_response($result[0], \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Wishlist was not found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

    public function wishlist_delete() {
        $id = $this->get('id');
        $uId = $this->session->userdata('userId');
        if ($id <= 0 || $id === NULL) {
            // Set the response and exit
            $this->response(null, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }else{
            $result = $this->WishListModel->deleteWishList($id , $uId);
            if($result){
                $message = [
                    'id' => $result,
                    'message' => 'Wish list deleted successfully'
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_ACCEPTED);
            }else{
                $message = [
                    'id' => $result,
                    'message' => 'Wish list was not found'
                ];
                $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function wishlist_put() {
        $id = $this->put('id');
        $imgUrl = $this->put('img_url');
        if(!$this->isImage($imgUrl)){
            $imgUrl = "assets/img/wishlist.png";
        }
        $data = [
            'name' => $this->put('name'),
            'occasion' => $this->put('occasion'),
            'description' => $this->put('description'),
            'img_url' => $imgUrl,
            'updated_at' => date("Y-m-d h:m:s")
        ];
        $result = $this->WishListModel->updateWishList($id, $data);
        if ($result) {
            $this->set_response($result[0], \Restserver\Libraries\REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code
        } else {
            $message = [
                'status' => false,
                'message' => "Wish List were not found"
            ];
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    private function isEmpty($value) {
        return (!isset($value) || trim($value) === '');
    }

    function isImage($url) {
        return preg_match("/^[^\?]+\.(jpg|jpeg|gif|png)(?:\?|$)/", $url);
    }
}