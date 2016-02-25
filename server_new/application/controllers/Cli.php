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

    public function jsapi_ticket()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?" .
            "grant_type=client_credential" .
            "&appid=" . $this->config->item('wx_appid') .
            "&secret=" . $this->config->item('wx_secret');
        $r = (array) json_decode(file_get_contents($url));
        if (isset($r['access_token']))
            $this->config->set_item('jsapi_ticket', $r['access_token']);
        else
            $this->jsapi_ticket();
        echo $this->config->item('jsapi_ticket');
        echo "\n";
    }

}