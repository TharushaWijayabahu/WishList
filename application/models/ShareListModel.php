<?php


class ShareListModel extends CI_Model{

    public function __construct() {
        $this->load->database();
    }

    public function shareLink($uID, $wID, $isShared){
        $data = [
            "u_id" => $uID,
            "w_id" => $wID,
            "is_shared" => $isShared,
            'created_at' => date("Y-m-d h:m:s"),
            'updated_at' => date("Y-m-d h:m:s")
        ];

        $this->db->insert('shared_link', $data);
        $id = $this->db->insert_id();
        if($id > 0){
            $url = base_url('index.php/sharelink/').$uID. '/'. $id;

            $this->db->set('url', $url);
            $this->db->set('updated_at', date("Y-m-d h:m:s"));
            $this->db->where('id', $id);
            $query = $this->db->update('shared_link');
            if($query){
                $result = $this->db->get_where('shared_link', array('id' => $id));
                return $result->result();
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    public function updateLink($id, $isShared){
        $this->db->set('is_shared', $isShared);
        $this->db->set('updated_at', date("Y-m-d h:m:s"));
        $this->db->where('id', $id);
        $query = $this->db->update('shared_link');

        if ($query) {
            $result = $this->db->get_where('shared_link', array('id' => $id));
            return $result->result();
        } else {
            return FALSE;
        }
    }

    public function getLink($userId){
        $query = $this->db->get_where('shared_link', array('u_id' => $userId));
        if ($query->num_rows() < 1) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function getLinkByID($id){
        $query = $this->db->get_where('shared_link', array('id' => $id));
        if ($query->num_rows() < 1) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function deleteLink($id){
        if($this->getLinkByID($id)){
            $this->db->where('id', $id);
            $this->db->delete('shared_link');
            return TRUE;
        }else{
            return  FALSE;
        }
    }

}