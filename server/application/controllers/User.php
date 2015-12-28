<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class User extends REST_Controller {

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
		if (md5($str) != $verifi)
			return false;
		else
			return true;
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
		if (abs($param['create_time'] - $cur_time) > 60*15)
		{
			$response['code']       = '301';
			$response['message']    = 'Expire request.';
		}

		if (!$this->valid($param, $verifi))
		{
			$response['code']       = '300';
			$response['message']    = 'Illegal request.';
		}

		if (!preg_match('/^1(?:3[0-9]|5[012356789]|8[0256789]|7[0678])(?P<separato>-?)\d{4}(?P=separato)\d{4}$/'
			, $param['phone']))
        {
			$response['code']       = '201';
			$response['message']    = 'Invalid phone number.';
		}

        if (strlen($param['passwd']) != 32)
		{
			$response['code']       = '202';
			$response['message']    = 'Invalid password.';
		}

        if (isset($_SESSION['captcha'.$param['phone']]))
			if ($_SESSION['captcha'.$param['phone']] != $param['captcha'])
			{
				$response['code']       = '203';
				$response['message']    = 'Invalid captcha.';
			}
		else
		{
			$response['code']       = '204';
			$response['message']    = 'No captcha, retry please.';
		}

		$this->user_model->register();

        $this->response($response);
    }

	public function login_post()
	{
		$param['phone']      = (string) $this->post('phone');
		$password   = (string) $this->post('password');
		$this->response($param['phone'].$password);
	}
}