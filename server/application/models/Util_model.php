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

    /**
     *
     * 生成一个验证码
     *
     * @param string $name
     * @param int $expire
     * @return bool
     * @author LuHao
     */
    public function apply_captcha($name = '', $expire = 900) {
        $name = 'captcha'.$name;
        if (isset($_SESSION[$name]))
            return false;
        if ($this->config->item('fixed_captcha'))
            $_SESSION[$name] = '4319';
        else
            $_SESSION[$name] = (string) rand(1000, 9999);
        // todo: send sms to user;
        $this->session->mark_as_temp($name, $expire);
        return true;
    }

    /**
     *
     * 检查验证码是否正确
     *
     * @param string $name
     * @return null
     * @author LuHao
     */
    public function check_captcha($name = '') {
        $name = 'captcha'.$name;
        if (isset($_SESSION[$name]))
            return $_SESSION[$name];
        else
            return null;
    }

    /**
     *
     * 返回逆编码地理位置
     *
     * @param $lat
     * @param $lng
     * @return mixed
     * @author LuHao
     */
    public function address($lat, $lng)
    {
        $ak  = $this->config->item('baidu_map_web_api_ak');
        $url = 'http://api.map.baidu.com/geocoder/v2/';
        $this->load->library('curl');
        $post_data = array (
            "ak"        => $ak,
            "callback"  => "renderReverse",
            "location"  => $lat.','.$lng,
            "pois"      => 0,
            "output"    => "json"
        );
        $output = $this->curl->simple_get($url, $post_data);
        return $output;
    }

}