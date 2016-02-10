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
        $this->param_validation->valid_phone($this->params['phone']);
        $this->result->data =
            $this->coachModel->register($this->params);
        $this->response();
    }

    public function list_coach()
    {
        $this->result->data = $this->coachModel->list_coach($this->params);
    }

    public function check_coach_detail()
    {
        $coach = $this->coachModel->valid_coach($this->params);
        if ( ! isset($coach))
            $this->responseWithCustom(301, '教练不存在');
        $this->result->data = $coach;
    }

    public function check_coach_photos()
    {
        $photos = $this->coachModel->coach_photos($this->params);
        if ( ! isset($coach))
            $this->responseWithCustom(301, '教练不存在');
        $this->result->data = $photos;
    }

}