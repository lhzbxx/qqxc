<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/2/17
 * Time: 17:20
 */

class Wechat extends MY_API_Controller {

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
        $this->userModel->update_location($lng, $lat);
    }

    /**
     *
     * 是否已经绑定微信号
     *
     * @author: LuHao
     */
    public function is_binded()
    {
        $openid = $this->params['openid'];
        $this->result->data = $this->userModel->is_wx_binded($openid);
        $this->response();
    }

    /**
     *
     * 尝试登录
     *
     * @author: LuHao
     */
    public function login()
    {
        $openid = $this->params['openid'];
//        $this->result->data = $this->userModel->wx_login($openid);
        $this->userModel->wx_login($openid);
        $this->response();
    }

    /**
     *
     * 微信JS_CONFIG
     *
     * @author: LuHao
     */
    public function config()
    {
        $params = array(
            'url'           => $this->params['url'],
            'jsapi_ticket'  => $this->config->item('jsapi_ticket'),
            'timestamp'     => time(),
            'noncestr'      => $this->util->random_str(16)
        );
        $params['signature'] = $this->util->wx_sign($params);
        $params['jsapi_ticket'] = '';
        $this->result->data = $params;
        $this->response();
    }

    /**
     *
     * 定位到具体城市
     *
     * @author: LuHao
     */
    public function city()
    {
        $url = "http://api.map.baidu.com/geocoder/v2/?ak=" .
            $this->config->item('baidu_ak') .
            "&callback=renderReverse&location=" .
            $this->params['lat'] .
            "," . $this->params['lng'] .
            "&output=xml&pois=0&coordtype=wgs84ll";
        $r = file_get_contents($url);
        $xml = $this->util->parse_xml($r);
        $city = (string) $xml->result->addressComponent->city;
        $this->result->data = $city;
        $this->response();
    }

    /**
     *
     * 检查和记录用户的openid
     *
     * @author: LuHao
     */
    public function openid()
    {
        $code = $this->params['code'];
        // 通过refresh_token获取openid
        if (isset($this->params['refresh_token']))
        {
            $refresh_token = $this->params['refresh_token'];
            $url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid="
                . $this->config->item('wx_appid')
                . "&grant_type=refresh_token&refresh_token="
                . $refresh_token;
            $r = (array) json_decode(file_get_contents($url));
            if (isset($r['openid']))
            {
                $this->result->data = array(
                    'openid' => $r['openid'],
                    'refresh_token' => $r['refresh_token']
                );
                $this->response();
            }
            else
            {
                $this->util->response_custom(301, 'refresh_token失效');
            }
        }
        // 通过授权的code获取openid
        $url =  "https://api.weixin.qq.com/sns/oauth2/access_token?appid="
            . $this->config->item('wx_appid')
            . "&secret="
            . $this->config->item('wx_secret')
            . "&code=" . $code . "&grant_type=authorization_code";
        $r = (array) json_decode(file_get_contents($url));
        if (isset($r['errcode']))
        {
            $this->util->response_custom(301, 'access_token获取失败', $r['errmsg']);
        }
        $openid = $r['openid'];
        $refresh_token = $r['refresh_token'];
        $access_token = $r['access_token'];
        $this->result->data = array(
            'openid' => $openid,
            'refresh_token' => $refresh_token
        );
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token="
            . $access_token . "&openid=" . $openid . "&lang=zh_CN";
        $r = (array) json_decode(file_get_contents($url));
        $this->result->data = $r;
        $sex = array(
            'N',
            'M',
            'F'
        );
        if ( ! $this->userModel->is_wx_binded($openid))
        {
            $this->userModel->add_user(array(
                'wx_openid' => $openid,
                'gender' => $sex[(int)$r['sex']],
                'avatar' => $r['headimgurl'],
                'nickname' => $r['nickname'],
                'city' => $r['city']
            ));
        }
        $this->response();
    }

}