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
        $this->load->model('CoachModel');
        $this->load->model('UserModel');
    }

    public function register()
    {
        $this->param_validation->valid_phone($this->params['phone']);
        $this->result->data =
            $this->adminModel->register($this->params);
        $this->response();
    }

    public function add_coach()
    {
        $this->param_validation->valid_phone($this->params['phone']);
        $this->coachModel->register($this->params);
        $this->response();
    }

    public function add_coach_photo()
    {

    }

    public function remove_coach_photo()
    {

    }

    public function add_coach_car()
    {

    }

    public function remove_coach_car()
    {

    }

}