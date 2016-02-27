<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/26
 * Time: 下午9:24
 */
class Order extends MY_API_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('orderModel');
        $this->load->model('coachModel');
    }

    public function prepay()
    {
        $time = time();
        $rand = $this->util->random_str_safe(16);
        $params = array(
            'url' => $this->params['url'],
            'jsapi_ticket' => $this->config->item('jsapi_ticket'),
            'timestamp' => $time,
            'noncestr' => $rand
        );
        $params['signature'] = $this->util->wx_sign($params);
        $params['jsapi_ticket'] = '';
        $pay_id = 19911105199513 + rand(15, 30);
        $params['prepay_id'] = $this->wx_pay($pay_id, $rand);
        $pay_params = array(
            'appId' => $this->config->item('wx_appid'),
            'timeStamp' => $time,
            'nonceStr' => $rand,
            'package' => 'prepay_id=' . $params['prepay_id'],
            'signType' => 'MD5'
        );
//        print_r($pay_params);
//        print_r($params);
        $params['paySign'] = $this->util->wx_pay_sign($pay_params);
//        if ( ! $this->coachModel->valid_coach($this->params['coach_id']))
//            $this->responseWithCustom(301, '教练不存在');
        $this->result->data = $params;
        $this->response();
    }

    public function wx_pay($pay_id, $rand)
    {
        $params = array(
            'appid'         => $this->config->item('wx_appid'),
            'attach'        => '学车费',
            'body'          => '快来学车',
            'mch_id'        => $this->config->item('wx_mchid'),
            'nonce_str'     => $rand,
            'notify_url'    => 'http://120.27.194.121:8877/index.php/api/wx/1/order/pay_notify',
            'openid'        => $this->input->get_request_header('api_key'),
            'out_trade_no'  => $pay_id,
            'spbill_create_ip' => $this->input->ip_address(),
            'total_fee'     => 1,
            'trade_type'    => 'JSAPI'
        );
        $params['sign'] = $this->util->wx_pay_sign($params);
        $xml = '<xml>';
        foreach ($params as $j=>$k)
            $xml .= '<' . $j . '>' . $k . '</' . $j . '>';
        $xml .= '</xml>';
        $prepay_id = $this->fetch_prepay_id($xml);
        // todo: 获取不到prepay_id的处理.
//        if ( ! $prepay_id)
//            $prepay_id = $this->fetch_prepay_id($xml);
        return $prepay_id;
    }

    private function fetch_prepay_id($xml)
    {
        $url =  "https://api.mch.weixin.qq.com/pay/unifiedorder";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $xml = $this->util->parse_xml(curl_exec($ch));
        return (string) $xml->prepay_id;
    }

    public function pay_notify()
    {
        $xml = file_get_contents('php://input');
        $xml = $this->util->parse_xml($xml);
        $openid = (string) $xml->openid;
        $result_code = (string) $xml->result_code;
        $transaction_id = (string) $xml->transaction_id;
        $time_end = (string) $xml->time_end;
        $this->orderModel->add_order();
        $this->api_key->set_key('notify:' . time(), $openid, 1000);
        $xml = "<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>";
        $this->output->set_content_type('text/xml');
        $this->output->set_output($xml);
    }

    public function check_pay_state()
    {
        $rand = $this->util->random_str_safe(16);
        $params = array(
            'appid'         => $this->config->item('wx_appid'),
            'mch_id'        => $this->config->item('wx_mchid'),
            'nonce_str'     => $rand,
            'transaction_id'=> '123'
        );
        $params['sign'] = $this->util->wx_pay_sign($params);
        $xml = '<xml>';
        foreach ($params as $j=>$k)
            $xml .= '<' . $j . '>' . $k . '</' . $j . '>';
        $xml .= '</xml>';
        if ($this->fetch_pay_state($xml))
        {
            // todo: 支付成功。
        }
        else
        {
            // todo: 支付失败。
        }
        $this->response();
    }

    private function fetch_pay_state($xml)
    {
        $url =  "https://api.mch.weixin.qq.com/pay/orderquery";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $xml = $this->util->parse_xml(curl_exec($ch));
        $return_code = (string) $xml->return_code;
        $result_code = (string) $xml->result_code;
        return $return_code === 'SUCCESS' && $result_code == 'SUCCESS';
    }


}