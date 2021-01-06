<?php


class WishItemModel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getAllPriority(){
        $query = $this->db->get('priority');
        if ($query->num_rows() < 1) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function getAllItems($userId, $wishListId) {
        $this->db->select('item.id, item.w_id, item.pr_id, item.title, item.price, item.qty, item.url, item.img_url,
         priority.name AS pr_name, priority.pr_level, item.created_at, item.updated_at');
        $this->db->from('item');
        $this->db->join('priority', 'item.pr_id = priority.id');
        $this->db->order_by('pr_level', 'ASC');
        $this->db->where('w_id', $wishListId);
        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function getItemById($id) {
        $query = $this->db->get_where('item', array('id' => $id));
        if ($query->num_rows() < 1) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function createItem($data){
        $this->db->insert('item', $data);
        $id = $this->db->insert_id();
        if ($id > 0) {
            $query = $this->db->get_where('item', array('id' => $id));
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function updateItem($id, $data){
        $this->db->where('id', $id);
        $query = $this->db->update('item', $data);

        if ($query) {
            $result = $this->db->get_where('item', array('id' => $id));
            return $result->result();
        } else {
            return FALSE;
        }
    }

    public function deleteItem($id){
        if($this->getItemById($id)){
            $this->db->where('id', $id);
            $this->db->delete('item');
            return TRUE;
        }else{
            return  FALSE;
        }
    }
}