<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class User_cash extends REST_Controller {

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
        if (mb_strtoupper(md5($str)) != mb_strtoupper($verifi))
            return false;
        else
            return true;
    }

    public function wx_pay_callback()
    {
        // todo: 微信回调处理
    }

    public function ali_pay_callback()
    {
        // todo: 支付宝回调处理
    }

}