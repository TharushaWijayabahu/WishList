<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function registerUser($name, $email, $password, $address, $mobile) {

        $query = $this->db->get_where('user', array('email' => $email));

        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $data = array(
                'name' => $name,
                'email' => $email,
                'password' => $hashPassword,
                'address' => $address,
                'tel' => $mobile,
                'created_at' => date("Y-m-d h:m:s"),
                'updated_at' => date("Y-m-d h:m:s")
            );
            $this->db->insert('user', $data);
            return TRUE;
        }
    }

    function getUser($id){
        $this->db->select('id, name, email, address, tel, created_at, updated_at');
        $query = $this->db->get_where('user', array('id' => $id));
        if ($query->num_rows() != 1) {
            return false;
        }else{
            return $query->result();
        }
    }

    function updateUser($id, $data){
        $this->db->where('id', $id);
        $query = $this->db->update('user', $data);

        if($query){
            $this->db->select('id, name, email, address, tel, created_at, updated_at');
            $result = $this->db->get_where('user', array('id' => $id));
            return $result->result();
        }else{
            return FALSE;
        }
    }

}