<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Test extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function valid_get($phone)
    {
        $query = $this->db->get_where('user',
            array('phone' => $phone),
            1);
        $this->response($query);
    }

}