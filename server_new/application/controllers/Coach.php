<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/9
 * Time: 上午9:03
 */
class Coach extends MY_API_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('coachModel');
    }

    public function register()
    {
        $this->param_validation->valid_phone($this->params['phone']);
        $this->result->data =
            $this->coachModel->register($this->params);
        $this->response();
    }

    public function add_coach()
    {
        $this->response();
    }

    public function detail()
    {
        $this->result->data =
            $this->coachModel->detail($this->params['coach_id'], $this->params['type'],
                $this->params['lat'], $this->params['lng']);
        $this->response();
    }

    public function mine_detail()
    {
        $this->result->data =
            $this->coachModel->mine();
        $this->response();
    }

    public function list_coach()
    {
        $page = $this->params['page'];
        $query = $this->params['query'];
        $city = $this->coachModel->confirm_city();
        if ( ! $city)
            $this->responseWithCustom(302, '未知城市');
        if ($query == 'auto')
            $this->result->data = $this->coachModel->list_coach_auto(
                $page, $this->params['lat'], $this->params['lng']);
        elseif ($query == 'dis')
            $this->result->data = $this->coachModel->list_coach_dis(
                $page, $this->params['lat'], $this->params['lng']);
        elseif ($query == 'price')
            $this->result->data = $this->coachModel->list_coach_price(
                $page, $this->params['lat'], $this->params['lng']);
        else
            $this->responseWithCustom(301, '未知排序方式');
        $this->response();
    }

    public function comment()
    {
        $content = $this->params['content'];
        $this->coachModel->add_comment($content);
        $this->response();
    }

    public function check_coach_detail()
    {
        $coach = $this->coachModel->valid_coach($this->params);
        if ( ! isset($coach))
            $this->responseWithCustom(301, '教练不存在');
        $this->result->data = $coach;
        $this->response();
    }

    public function check_coach_photos()
    {
        $photos = $this->coachModel->coach_photos($this->params);
        if ( ! isset($coach))
            $this->responseWithCustom(301, '教练不存在');
        $this->result->data = $photos;
        $this->response();
    }

}