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

    public function receive_coupon()
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

        $this->load->model('User_model');

        if (!$this->User_model->valid_openid($param['openid']))
        {
            $response['code']       = '202';
            $response['message']    = 'Invalid openid.';
            $this->response($response);
        }

        $this->load->model('Coupon_model');

        $coupon_id = $this->Coupon_model->get_coupon_id($param['phone'], $param['captcha']);
        if (!$coupon_id)
        {
            $response['code']       = '203';
            $response['message']    = 'Invalid coupon.';
            $this->response($response);
        }

        if (!$this->Coupon_model->valid_coupon($coupon_id))
        {
            $response['code']       = '204';
            $response['message']    = 'Used coupon.';
            $this->response($response);
        }

        $user_id = $this->User_model->get_user_id_by_openid($param['openid']);
        if (!$this->Coupon_model->valid_user($user_id, 0))
        {
            $response['code']       = '205';
            $response['message']    = 'No auth to receive.';
            $this->response($response);
        }

        $this->Coupon_model->use_coupon($user_id, $coupon_id);

        $this->response($response);
    }

}