<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/9
 * Time: 上午8:48
 */

class User extends MY_API_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function register()
    {
        $this->param_validation->valid_phone($this->params['phone']);
        $this->result->data =
            $this->userModel->register($this->params);
        $this->response();
    }

    public function bind_wx()
    {
        $this->param_validation->valid_phone($this->params['phone']);
        $this->result->data =
            $this->userModel->bind_wx($this->params);
        $this->response();
    }

}