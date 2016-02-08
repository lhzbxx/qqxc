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

    /*
     * 验证接口调用时间是否过期
     */
    public function valid_time($time)
    {
        if(abs(time() - $time) > 15*60)
            return false;
        else
            return true;
    }

    /*
     * 验证 sign
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

    /*
     * 计算校验值
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

    /*
     * 生成随机字符串
     */
    function random_str($length = 6)
    {
        $str = '';
        for ($i = 0; $i < $length; $i++)
            $str .= chr(mt_rand(33, 126));
        return $str;
    }

    /*
     * 生成结果
     */
    public function result($code)
    {
        $result = new Result();
        $result->code = $code;
        $result->msg = $this->CI->config->item('status_code')[$code];
        return $result;
    }

    /*
     * 自定义返回结果
     * 一般是异常处理
     */
    public function response_custom($code, $msg)
    {
        $result = new Result();
        $result->code = $code;
        $result->msg = $msg;
        $this->CI->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit();
    }

    /*
     * 输出信息
     */
    public function response($result)
    {
        $this->CI->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit();
    }

    /*
     * 发送短信
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

}