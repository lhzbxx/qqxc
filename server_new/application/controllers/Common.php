<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/7
 * Time: 上午12:04
 */
class Common extends MY_API_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('captcha');
        $this->load->library('util');
    }

    /**
     *
     * 请求手机验证码
     *
     * @author: LuHao
     */
    public function request_captcha_code()
    {
        $phone = $this->params['phone'];
        $key = 'captcha:' . $phone;
        $this->param_validation->valid_phone($phone);
        if ($this->captcha->get_captcha($key))
        {
            $this->result->code = '201';
            $this->result->msg = '请稍后重试';
        }
        else
        {
            $captcha = (string) rand(1000, 9999);
            $this->captcha->set_captcha($key, $captcha);
            $this->util->send_sms($phone, '您的验证码是' .
            $captcha);
        }
        $this->response();
    }

}