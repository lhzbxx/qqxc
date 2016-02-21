<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/31
 * Time: 下午4:16
 */

class Param_validation {

    private $CI;
    private $result;

    public function __construct()
    {
        $this->CI= & get_instance();
        $this->CI->load->library('util');
        $this->CI->load->library('captcha');
        $this->result = new Result();
    }

    public function valid_phone($phone)
    {
        if ( ! preg_match(
            '/^1(?:3[0-9]|5[012356789]|8[0256789]|7[0678])(?P<separato>-?)\d{4}(?P=separato)\d{4}$/'
            , $phone))
        {
            $this->config(401, '手机号格式错误');
            $this->show();
        }
    }

    public function valid_password($password)
    {
        if (strlen(trim($password)) != 32)
        {
            $this->config(402, '密码格式错误');
            $this->show();
        }
    }

    public function valid_null($param, $code, $msg)
    {
        if ( ! $param)
        {
            $this->config($code, $msg);
            $this->show();
        }
    }

    public function valid_int($param, $code, $msg)
    {
        if ( ! is_int((int)$param))
        {
            $this->config($code, $msg);
            $this->show();
        }
    }

    public function valid_fill(&$param, $fill, $default)
    {
        if ( ! isset($param[$fill]))
        {
            $param[$fill] = $default;
        }
    }

    public function valid_captcha($phone, $captcha)
    {
        return $captcha === $this->CI->captcha->get_captcha('captcha:' . $phone);
    }

    private function config($code, $msg)
    {
        $this->result->code = $code;
        $this->result->msg = $msg;
    }

    private function show()
    {
        $this->CI->util->response($this->result);
    }

}