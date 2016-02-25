<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/25
 * Time: 下午1:17
 */

class Cli extends MY_CLI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function test()
    {
        echo "OK";
        echo "\n";
    }

    public function access_token()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?" .
            "grant_type=client_credential" .
            "&appid=" . $this->config->item('wx_appid') .
            "&secret=" . $this->config->item('wx_secret');
        $r = (array) json_decode(file_get_contents($url));
        if (isset($r['access_token']))
            $this->config->set_item('access_token', $r['access_token']);
        else
            $this->access_token();
        echo 'access_token: ' . $this->config->item('access_token');
        echo "\n";
        return $this->config->item('access_token');
    }

    public function jsapi_ticket()
    {
        $access_key = $this->access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" .
            $access_key . "&type=jsapi";
        $r = (array) json_decode(file_get_contents($url));
        if (isset($r['ticket']))
            $this->config->set_item('jsapi_ticket', $r['ticket']);
        else
            $this->jsapi_ticket();
        echo 'jsapi_ticket: ' . $this->config->item('jsapi_ticket');
        echo "\n";
        return $this->config->item('jsapi_ticket');
    }

    public function check($name)
    {
        echo $name . ': ' . $this->config->item($name);
        echo "\n";
    }

}