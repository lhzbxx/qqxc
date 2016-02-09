<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/9
 * Time: 上午9:03
 */

class Coach extends MY_API_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CoachModel');
    }

    public function register()
    {
        $this->Param_validation->valid_phone($this->params['phone']);
        $this->result->data =
            $this->coachModel->register($this->params);
        $this->response();
    }

}