<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WishListModel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function createWishList($data) {
        $this->db->insert('wish_list', $data);
        $id = $this->db->insert_id();
        if ($id > 0) {
            $query = $this->db->get_where('wish_list', array('id' => $id));
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function getAllWishList($userId) {
        $query = $this->db->get_where('wish_list', array('u_id' => $userId));
        if ($query->num_rows() < 1) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function updateWishList($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('wish_list', $data);

        if ($query) {
            $result = $this->db->get_where('wish_list', array('id' => $id));
            return $result->result();
        } else {
            return FALSE;
        }
    }

    public function getWishListById($userId, $id) {
        $query = $this->db->get_where('wish_list', array('u_id' => $userId, 'id' => $id));
        if ($query->num_rows() < 1) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function getWishList($id){
        $query = $this->db->get_where('wish_list', array('id' => $id));
        if ($query->num_rows() < 1) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function deleteWishList($id){
        if($this->getWishList($id)){
            $this->db->where('id', $id);
            $this->db->delete('wish_list');
            return TRUE;
        }else{
            return  FALSE;
        }
    }
}