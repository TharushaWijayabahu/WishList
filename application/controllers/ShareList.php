<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShareList extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function shared(){
        $this->load->view('sharelist');
    }
}