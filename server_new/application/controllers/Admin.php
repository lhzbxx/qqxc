<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/8
 * Time: 下午11:40
 */

class Admin extends MY_API_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
    }

}