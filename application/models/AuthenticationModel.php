<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthenticationModel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function authenticateUser($email, $password){

        $query = $this->db->get_where('user', array('email' => $email));

        if ($query->num_rows() != 1) {
            return false;
        } else {
            $row = $query->row();

            $hashPassword = $row->password;

            if (password_verify($password, $hashPassword)) {
                $this->session->set_userdata('isLoggedIn', true);
                $this->session->set_userdata('userId', $row->id);
                return true;
            } else {
                return false;
            }
        }

    }

    public function logout(){
        foreach ($this->session->all_userdata() as $row => $value) {
            $this->session->unset_userdata($row);
        }
        $this->session->sess_destroy();
        return true;
    }

    function isLoggedIn() {

        if (isset($this->session->isLoggedIn)) {
            return $this->session->isLoggedIn;

        } else {
            return false;
        }
    }

}