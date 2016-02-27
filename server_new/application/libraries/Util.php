<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/31
 * Time: 上午8:50
 */

class Util {

    private $CI;

    public function __construct()
    {
        $this->CI= & get_instance();
    }

    /**
     *
     * 验证接口调用时间是否过期
     *
     * @param $time
     * @return bool
     * @author: LuHao
     */
    public function valid_time($time)
    {
        if(abs(time() - $time) > 15*60)
            return false;
        else
            return true;
    }

    /**
     *
     * 验证签名
     *
     * @param $params
     * @param $sign
     * @return bool
     * @author: LuHao
     */
    public function valid_sign($params, $sign){
        $str = '';
        ksort($params);
        foreach ($params as $k => $v) {
            $str .= "$k=$v";
        }
        if (strtoupper(md5($str)) == strtoupper($sign))
            return true;
        else
            return false;
    }

    /**
     *
     * 计算校验值(MD5)
     * 即签名
     *
     * @param $params
     * @return string
     * @author: LuHao
     */
    public function sign($params)
    {
        $str = '';
        ksort($params);
        foreach ($params as $k => $v) {
            $str .= "$k=$v";
        }
        return md5($str);
    }

    /**
     *
     * 计算校验值(SHA1)
     *
     * @param $params
     * @return string
     * @author: LuHao
     */
    public function wx_sign($params, $type='sha1')
    {
        $str = '';
        ksort($params);
        foreach ($params as $k => $v) {
            $str .= "&$k=$v";
        }
        if ($type == 'sha1')
            return sha1(substr($str, 1));
        return md5(substr($str, 1));
    }

    /**
     *
     * 微信支付签名
     *
     * @param $params
     * @return string
     * @author: LuHao
     */
    public function wx_pay_sign($params)
    {
        $str = '';
        ksort($params);
        foreach ($params as $k => $v) {
            $str .= "&$k=$v";
        }
        return strtoupper(md5(substr($str, 1) . '&key=' . $this->CI->config->item('wx_key')));
    }

    /**
     *
     * 生成随机字符串
     *
     * @param int $length
     * @return string
     * @author: LuHao
     */
    function random_str($length = 6)
    {
        $str = '';
        for ($i = 0; $i < $length; $i++)
            $str .= chr(mt_rand(33, 126));
        return $str;
    }

    /**
     *
     * 生成随机字符串
     *
     * @param int $length
     * @return string
     * @author: LuHao
     */
    function random_str_safe($length = 6)
    {
        $k = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890';
        $str = '';
        for ($i = 0; $i < $length; $i++)
            $str .= substr($k, mt_rand(0, 61), 1);
        return $str;
    }

    /**
     *
     * 生成响应结果
     *
     * @param $code
     * @return Result
     * @author: LuHao
     */
    public function result($code)
    {
        $result = new Result();
        $result->code = $code;
        $result->msg = $this->CI->config->item('status_code')[$code];
        return $result;
    }

    /**
     *
     * 自定义返回结果
     * 一般是异常处理
     *
     * @param $code
     * @param $msg
     * @author: LuHao
     */
    public function response_custom($code, $msg, $data=null)
    {
        $result = new Result();
        $result->code = $code;
        $result->msg = $msg;
        $result->data = $data;
        $this->CI->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit();
    }

    /**
     *
     * 输出信息
     *
     * @param $result
     * @author: LuHao
     */
    public function response($result)
    {
        $this->CI->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit();
    }

    /**
     *
     * 发送短信
     *
     * @param $phone
     * @param $content
     * @author: LuHao
     */
    public function send_sms($phone, $content)
    {
        $argv = array(
            'sn' => 'SDK-LMQ-010-00031',
            'pwd' => strtoupper(md5('SDK-LMQ-010-00031' . 'bc0-4fa)')),
            'mobile' => $phone,
            'content' => urlencode($content . '【快来学车】'),
            'ext' => '',
            'rrid' => '',
            'stime' => ''
        );
        $flag = 0;
        $params = '';
        foreach ($argv as $key => $value) {
            if ($flag != 0) {
                $params .= "&";
                $flag = 1;
            }
            $params .= $key . "=";
            $params .= urlencode($value);
            $flag = 1;
        }
        $length = strlen($params);
        $fp = fsockopen("sdk2.entinfo.cn", 8060, $errno, $errstr, 10) or exit($errstr . "--->" . $errno);
        $header = "POST /webservice.asmx/mdSmsSend_u HTTP/1.1\r\n";
        $header .= "Host:sdk2.entinfo.cn\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . $length . "\r\n";
        $header .= "Connection: Close\r\n\r\n";
        $header .= $params . "\r\n";
        fputs($fp, $header);
    }

    /**
     *
     * 解析XML
     *
     * @param $xml_str
     * @return SimpleXMLElement
     * @author: LuHao
     */
    public function parse_xml($xml_str)
    {
        $xml = simplexml_load_string($xml_str);
        return $xml;
    }

    /**
     *
     * 返回解析对象
     *
     * @param $xml
     * @param $obj
     * @return string
     * @author: LuHao
     */
    public function fetch_xml_obj($xml, $obj)
    {
        $r = (string) $xml->$obj;
        return $r;
    }

    /**
     *
     * 根据经纬度确认城市
     *
     * @param $lat
     * @param $lng
     * @return string
     * @author: LuHao
     */
    public function locate_city($lat, $lng)
    {
        $url = "http://api.map.baidu.com/geocoder/v2/?ak=" .
            $this->CI->config->item('baidu_ak') .
            "&callback=renderReverse&location=" .
            $lat . "," . $lng .
            "&output=xml&pois=0&coordtype=wgs84ll";
        $r = file_get_contents($url);
        $xml = $this->parse_xml($r);
        return (string) $xml->result->addressComponent->city;
    }


    /**
     *
     * 判断两个GPS坐标的距离
     *
     * @param $x
     * @param $y
     * @param $lat
     * @param $lng
     * @return int
     * @author: LuHao
     */
    function dis($x, $y, $lat, $lng) {
        return (2 * 6378.137 * asin(sqrt(pow(sin(pi() * ($y - $lat) / 360), 2)
                + cos(pi() * $x / 180) * cos($lat *  pi() / 180) * pow(sin(pi()
                    * ($x - $lng) / 360), 2))));
    }
}