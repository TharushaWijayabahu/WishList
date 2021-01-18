<?php


class ShareListModel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function shareLink($uID, $wID, $isShared) {
        $data = [
            "u_id" => $uID,
            "w_id" => $wID,
            "is_shared" => $isShared,
            'created_at' => date("Y-m-d h:m:s"),
            'updated_at' => date("Y-m-d h:m:s")
        ];

        $this->db->insert('shared_link', $data);
        $id = $this->db->insert_id();
        if ($id > 0) {
            $url = base_url('index.php/sharelist/shared/') . $uID . '/' . $id;

            $this->db->set('url', $url);
            $this->db->set('updated_at', date("Y-m-d h:m:s"));
            $this->db->where('id', $id);
            $query = $this->db->update('shared_link');
            if ($query) {
                $result = $this->db->get_where('shared_link', array('id' => $id));
                return $result->result();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function updateLink($id, $isShared) {
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

    public function getLink($userId) {
        $query = $this->db->get_where('shared_link', array('u_id' => $userId));
        if ($query->num_rows() < 1) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function getLinkByID($id) {
        $query = $this->db->get_where('shared_link', array('id' => $id));
        if ($query->num_rows() < 1) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function deleteLink($id) {
        if ($this->getLinkByID($id)) {
            $this->db->where('id', $id);
            $this->db->delete('shared_link');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getWishListById($id) {
        $this->db->select('w_id');
        $this->db->where('id', $id);
        $this->db->where('is_shared', 'yes');
        $query = $this->db->get("shared_link");
        if ($query->num_rows() < 1) {
            return $query->result();
        } else {
            $result = $query->result();
            return $result[0]->w_id;
        }
    }

    public function getSharedList($id) {
        $wId = $this->getWishListById($id);
        if ($wId) {
            $this->db->select('item.id, item.w_id, item.pr_id, item.title, item.price, item.qty, item.url, item.img_url,
         priority.name AS pr_name, priority.pr_level');
            $this->db->from('item');
            $this->db->join('priority', 'item.pr_id = priority.id');
            $this->db->order_by('pr_level', 'ASC');
            $this->db->where('w_id', $wId);
            $query = $this->db->get();

            if ($query->num_rows() < 1) {
                return false;
            } else {
                return $query->result();
            }
        } else {
            return "private";
        }
    }

    public function getSharedWishList($id) {
        $wId = $this->getWishListById($id);
        if ($wId) {
            $this->db->select('name,occasion,description');
            $this->db->where('id', $wId);
            $query = $this->db->get("wish_list");
            if ($query->num_rows() < 1) {
                return $query->result();
            } else {
                return $query->result();
            }
        } else {
            return "private";
        }
    }

    public function getUserById($id) {
        $this->db->select('u_id');
        $this->db->where('id', $id);
        $this->db->where('is_shared', 'yes');
        $query = $this->db->get("shared_link");
        if ($query->num_rows() < 1) {
            return $query->result();
        } else {
            $result = $query->result();
            return $result[0]->u_id;
        }
    }

    public function getSharedUser($id) {
        $uId = $this->getUserById($id);
        if ($uId) {
            $this->db->select('name');
            $this->db->where('id', $uId);
            $query = $this->db->get("user");
            if ($query->num_rows() < 1) {
                return $query->result();
            } else {
                return $query->result();
            }
        } else {
            return "private";
        }
    }

}