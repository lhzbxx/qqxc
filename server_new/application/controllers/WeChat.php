<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/2/17
 * Time: 17:20
 */

class WeChat extends MY_API_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('userModel');
        $this->load->library('util');
    }

    /**
     *
     * 微信回调地址
     *
     * @author: LuHao
     */
    public function redirect()
    {
        $xml = file_get_contents('php://input');
        $xml = $this->util->parse_xml($xml);
        $event = $this->util->fetch_xml_obj($xml, 'Event');
        if ($event === '<![CDATA[LOCATION]]>')
            $this->redirect_location($xml);
        $this->response();
    }

    private function redirect_location($xml)
    {
        $lat = $this->util->fetch_xml_obj($xml, 'Latitude');
        $lng = $this->util->fetch_xml_obj($xml, 'Longitude');
    }

    /**
     *
     * 检查和记录用户的openid
     *
     * @author: LuHao
     */
    public function openid()
    {
        $this->response();
    }

}