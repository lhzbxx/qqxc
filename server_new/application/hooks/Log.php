<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/30
 * Time: 下午2:37
 */

class Log {

    private $CI;

    function Log()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('Util');
    }

    /**
     *
     * 日志Hook入口
     *
     * @author: LuHao
     */
    public function entrance()
    {
        $time = $this->CI->benchmark->elapsed_time();
        // todo: 超时报警.
    }

}