<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Coach extends REST_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function valid($param, $verifi)
    {
        $str = '';
        ksort($param);
        foreach ($param as $k => $v) {
            $str .= "$k=$v";
        }
        if (mb_strtoupper(md5($str)) == mb_strtoupper($verifi))
            return true;
        else
            return false;
    }

    public function verify($param)
    {
        $str = '';
        ksort($param);
        foreach ($param as $k => $v) {
            $str .= "$k=$v";
        }
        return md5($str);
    }

    public function add_coach_post()
    {
        $param = array(
            'phone'         => (string) $this->post('phone'),
            'name'          => (string) $this->post('name'),
            'seniority'     => (string) $this->post('seniority'),
            'car_type'      => (string) $this->post('car_type'),
            'school'        => (string) $this->post('school'),
            'avatar'        => (string) $this->post('avatar'),
            'sub2pass'      => (string) $this->post('sub2pass'),
            'sub2total'     => (string) $this->post('sub2total'),
            'sub3pass'      => (string) $this->post('sub3pass'),
            'sub3total'     => (string) $this->post('sub3total'),
            'service'       => (string) $this->post('service'),
            'address'       => (string) $this->post('address'),
            'latitude'      => (string) $this->post('latitude'),
            'longitude'     => (string) $this->post('longitude'),
            'star_total'    => (string) $this->post('star_total'),
            'star_num'      => (string) $this->post('star_num'),
			'create_time'   => (string) $this->post('create_time'),
        );
        $verifi = (string) $this->post('verifi');

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        $cur_time = date_timestamp_get(new DateTime());
        if (abs($param['create_time'] - $cur_time) > 60*15)
        {
            // todo: start expire validation.
            // $response['code']       = '301';
            // $response['message']    = 'Expire request.';
            // $this->response($response);
        }

        if (!$this->valid($param, $verifi))
        {
            $response['code']       = '302';
            $response['message']    = 'Illegal request.';
            // $response['data']       = $this->verify($param);
            $this->response($response);
        }

        if (!preg_match('/^1(?:3[0-9]|5[012356789]|8[0256789]|7[0678])(?P<separato>-?)\d{4}(?P=separato)\d{4}$/'
            , $param['phone']))
        {
            $response['code']       = '201';
            $response['message']    = 'Invalid phone number.';
            $this->response($response);
        }

        $this->load->model('Coach_model');

        if (!$this->Coach_model->valid_phone($param['phone']))
        {
            $response['code']       = '202';
            $response['message']    = 'Registered phone number.';
            $this->response($response);
        }

        $this->Coach_model-> add_coach($param['phone'], $param['name'], $param['seniority'], $param['car_type']
            , $param['school'], $param['avatar'], $param['sub2pass'], $param['sub2total'], $param['sub3pass']
            , $param['sub3total'], $param['service'], $param['address'], $param['latitude'], $param['longitude']
            , $param['star_total'], $param['star_num']);

        $this->response($response);
    }

    public function edit_coach_post()
    {
        $param = array(
            'id'            => (string) $this->post('id'),
            'phone'         => (string) $this->post('phone'),
            'name'          => (string) $this->post('name'),
            'seniority'     => (string) $this->post('seniority'),
            'car_type'      => (string) $this->post('car_type'),
            'school'        => (string) $this->post('school'),
            'avatar'        => (string) $this->post('avatar'),
            'sub2pass'      => (string) $this->post('sub2pass'),
            'sub2total'     => (string) $this->post('sub2total'),
            'sub3pass'      => (string) $this->post('sub3pass'),
            'sub3total'     => (string) $this->post('sub3total'),
            'service'       => (string) $this->post('service'),
            'address'       => (string) $this->post('address'),
            'latitude'      => (string) $this->post('latitude'),
            'longitude'     => (string) $this->post('longitude'),
            'star_total'    => (string) $this->post('star_total'),
            'star_num'      => (string) $this->post('star_num'),
            'create_time'   => (string) $this->post('create_time'),
        );
        $verifi = (string) $this->post('verifi');

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        $cur_time = date_timestamp_get(new DateTime());
        if (abs($param['create_time'] - $cur_time) > 60*15)
        {
            // todo: start expire validation.
            // $response['code']       = '301';
            // $response['message']    = 'Expire request.';
            // $this->response($response);
        }

        if (!$this->valid($param, $verifi))
        {
            $response['code']       = '302';
            $response['message']    = 'Illegal request.';
             $response['data']       = $this->verify($param);
            $this->response($response);
        }

        if (!preg_match('/^1(?:3[0-9]|5[012356789]|8[0256789]|7[0678])(?P<separato>-?)\d{4}(?P=separato)\d{4}$/'
            , $param['phone']))
        {
            $response['code']       = '201';
            $response['message']    = 'Invalid phone number.';
            $this->response($response);
        }

        $this->load->model('Coach_model');

        if ($this->Coach_model->valid_id($param['id']))
        {
            $response['code']       = '202';
            $response['message']    = 'Illegal ID.';
            $this->response($response);
        }

        $this->Coach_model-> edit_coach($param['id'], $param['phone'], $param['name'], $param['seniority'], $param['car_type']
            , $param['school'], $param['avatar'], $param['sub2pass'], $param['sub2total'], $param['sub3pass']
            , $param['sub3total'], $param['service'], $param['address'], $param['latitude'], $param['longitude']
            , $param['star_total'], $param['star_num']);

        $this->response($response);
    }

    public function change_status_post()
    {

        $param = array(
            'openid'        => (string) $this->post('openid'),
            'id'            => (string) $this->post('id'),
            'create_time'   => (string) $this->post('create_time'),
            'status'        => (string) $this->post('status')
        );
        $verifi = (string) $this->post('verifi');

        // status code
        // 0: normal;
        // 1: hide;
        // 2: show only;

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        $cur_time = date_timestamp_get(new DateTime());
        if (abs($param['create_time'] - $cur_time) > 60*15)
        {
            // todo: start expire validation.
            // $response['code']       = '301';
            // $response['message']    = 'Expire request.';
            // $this->response($response);
        }

        if (!$this->valid($param, $verifi))
        {
            $response['code']       = '302';
            $response['message']    = 'Illegal request.';
            $response['data']       = $this->verify($param);
            $this->response($response);
        }

        if (!preg_match('/^[012]$/'
            , $param['status']))
        {
            $response['code']       = '201';
            $response['message']    = 'Invalid status.';
            $this->response($response);
        }

        $this->load->model('Coach_model');

        if ($this->Coach_model->valid_id($param['id']))
        {
            $response['code']       = '202';
            $response['message']    = 'Illegal ID.';
            $this->response($response);
        }

        $this->Coach_model->change_status($param['id'], $param['status']);

        $this->response($response);
    }

    public function list_coach_post()
    {
        $param = array(
            'openid'    => (string) $this->post('openid'),
            'page'      => (int) $this->post('page')
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        if ($param['page'] == '')
            $param['page'] = 0;

        $this->load->model('Feedback_model');

        $response['data'] = $this->Feedback_model->list_20($param['page']);

        $this->response($response);
    }

    public function add_comment_post()
    {
        $param = array(
            'openid'    => (string) $this->post('openid'),
            'coach_id'  => (int) $this->post('coach_id'),
            'content'   => (string) $this->post('content'),
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        if ($param['page'] == '')
            $param['page'] = 0;

        $this->load->model('Feedback_model');

        $response['data'] = $this->Feedback_model->list_20($param['page']);

        $this->response($response);
    }

    public function list_comment_post()
    {
        $param = array(
            'openid'    => (string) $this->post('openid'),
            'page'      => (int) $this->post('page')
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        if ($param['page'] == '')
            $param['page'] = 0;

        $this->load->model('Feedback_model');

        $response['data'] = $this->Feedback_model->list_20($param['page']);

        $this->response($response);
    }

}