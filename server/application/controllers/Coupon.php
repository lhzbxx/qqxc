<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/1/2
 * Time: 12:29
 */
class Coupon extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function use_coupon()
    {
        $param = array(
            'openid'        => (string) $this->post('openid'),
            'phone'         => (string) $this->post('phone'),
            'captcha'       => (string) $this->post('captcha'),
            'create_time'   => date_timestamp_get(new DateTime()),
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
            $response['code']       = '301';
            $response['message']    = 'Illegal request.';
            $response['data']       = $this->verify($param);
            $this->response($response);
        }

        $this->load->model('User_model');

        if (!$this->User_model->valid_openid($param['openid']))
        {
            $response['code']       = '201';
            $response['message']    = 'Illegal openid.';
            $this->response($response);
        }

        $user_id = $this->User_model->get_user_id($param['openid']);

        $this->load->model('Coupon_model');

        if (!$this->User_model->valid_coupon($param['openid']))
        {
            $response['code']       = '202';
            $response['message']    = 'Unknown coupon.';
            $this->response($response);
        }

        $coupon_id = $this->Coupon_model->get_coupon_id($param['phone'], $param['captcha']);

        $valid_coupon = $this->Coupon_model->valid_coupon($coupon_id, $phone);

        $valid = $this->valid_coupon($coupon_id, $phone);
        if (!$valid)
            return false;
        $valid = $this->valid_user($user_id);
        if (!$valid)

        foreach ($rows->result() as $row)
        {
            $this->User_model->add_notice($row->user_id, $param['content'], 'system');
        }

        $this->response($response);
    }

}