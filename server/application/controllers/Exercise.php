<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/1/1
 * Time: 8:13
 */
class Exercise extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('base_tool');
    }

    public function add_right_post()
    {
        $param = array(
            'serial_number' => (int) $this->post('serial_number')
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        $this->load->model('Exercise_model');

        $this->Exercise_model->add_right_num($param['serial_number']);

        $this->response($response);
    }

    public function add_wrong_post()
    {
        $param = array(
            'serial_number' => (int) $this->post('serial_number')
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        $this->load->model('Exercise_model');

        $this->Exercise_model->add_wrong_num($param['serial_number']);

        $this->response($response);
    }

    public function get_right_rate_post()
    {
        $param = array(
            'serial_number' => (int) $this->post('serial_number')
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        $this->load->model('Exercise_model');

        $response['data'] = $this->Exercise_model->right_rate($param['serial_number']);

        $this->response($response);
    }

    public function sync_post()
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
        if (abs($param['create_time'] - $cur_time) > $this->config->item('captcha_expire'))
        {
            if ($this->config->item('time_expire_auth'))
            {
                $response['code']       = '301';
                $response['message']    = 'Expire request.';
                $this->response($response);
            }
        }

        if (!valid($param, $verifi))
        {
            $response['code']       = '302';
            $response['message']    = 'Illegal request.';
            if ($this->config->item('hide_verify_code'))
            {
                $response['data']   = verify($param);
            }
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

}