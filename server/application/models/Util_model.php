<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2015/12/28
 * Time: 16:41
 */

class Util_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function apply_captcha($name = '', $expire = 900) {
        $name = 'captcha'.$name;
        if (isset($_SESSION[$name]))
            return false;
        // $_SESSION[$name] = (string) rand(1000, 9999);
        $_SESSION[$name] = '4319';
        // todo: send sms to user;
        $this->session->mark_as_temp($name, $expire);
        return true;
    }

    public function check_captcha($name = '') {
        $name = 'captcha'.$name;
        if (isset($_SESSION[$name]))
            return $_SESSION[$name];
        else
            return null;
    }

}