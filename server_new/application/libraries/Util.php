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
    public function result($code) {
        $result = new Result();
        $result->code = $code;
        $result->msg = $this->CI->config->item('status_code')[$code];
        return $result;
    }

    /*
     * 输出信息
     */
    public function response($result){
        $this->CI->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit();
    }


    /*
     * 过期版本
     */
    public function invalid_version(){
        $result = new Result();
        $code = 206;
        $result->code = $code;
        $result->msg = $this->CI->config->item('status_code')[$code];
        $this->CI->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit();
    }

}