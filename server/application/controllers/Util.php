<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/CI_Controller.php');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2015/12/28
 * Time: 16:41
 */

class Util extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function apply_captcha($name = '',$expire = 900) {
        $name = 'captcha'.$name;
        if (isset($_SESSION[$name]))
            return false;
        $_SESSION[$name] = (string) rand(1000, 9999);
        // todo: send sms to user;
        $this->session->mark_as_temp($name, $expire);
        return true;
    }

}