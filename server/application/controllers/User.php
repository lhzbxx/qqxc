<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class User extends REST_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('base_tool');
	}

	public function register_post()
	{
		$param = array(
			'phone'         => (string) $this->post('phone'),
			'passwd'        => (string) $this->post('passwd'),
			'captcha'       => (string) $this->post('captcha'),
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

		$this->load->model('User_model');

		if (!$this->User_model->valid_phone($param['phone']))
		{
			$response['code']       = '205';
			$response['message']    = 'Registered phone number.';
			$this->response($response);
		}

        if (strlen($param['passwd']) != 32)
		{
			$response['code']       = '202';
			$response['message']    = 'Invalid password.';
			$this->response($response);
		}

		$this->load->model('Util_model');

        if ($this->Util_model->check_captcha($param['phone']))
		{
			if ($this->Util_model->check_captcha($param['phone']) != $param['captcha'])
			{
				$response['code'] = '203';
				$response['message'] = 'Invalid captcha.';
				$this->response($response);
			}
		}
		else
		{
			$response['code']       = '204';
			$response['message']    = 'No captcha, retry please.';
			$this->response($response);
		}

		$response['data'] = $this->User_model->register($param['phone'], $param['passwd']);

        $this->response($response);
    }

	public function captcha_post()
	{
		$phone = $this->post('phone');
		$response = array(
			'code'      => '100',
			'message'   => 'OK',
			'data'      => array()
		);
		$this->load->model('Util_model');
		$this->Util_model->apply_captcha($phone);
		$this->response($response);
	}

	public function login_post()
	{
		$param = array(
			'phone'         => (string) $this->post('phone'),
			'passwd'        => (string) $this->post('passwd'),
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

		$this->load->model('User_model');

		if ($this->User_model->valid_phone($param['phone']))
		{
			$response['code']       = '202';
			$response['message']    = 'Not registered yet.';
			$this->response($response);
		}

		if (!$this->User_model->check($param['phone'], $param['passwd']))
		{
			$response['code']       = '203';
			$response['message']    = 'Wrong password.';
			$this->response($response);
		}

		$response['data'] = $this->User_model->update_openid($param['phone']);

		$this->response($response);
	}
}