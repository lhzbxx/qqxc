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
        $this->load->model('userModel');
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
        if ( ! $this->param_validation->valid_captcha($this->params['phone'], $this->params['captcha']))
            $this->util->response_custom('301', '验证码不正确');
        $this->result->data =
            $this->userModel->bind_wx(
                $this->params['phone'], $this->params['password'], $this->params['openid']);
        $this->response();
    }

    public function update_location()
    {
        $this->userModel->update_location(
            $this->id, $this->params['lat'], $this->params['lng']);
        $this->response();
    }

    public function update_password()
    {
        $this->response();
    }

}