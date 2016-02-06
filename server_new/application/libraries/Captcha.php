<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/30
 * Time: 下午2:40
 */

class Captcha {

    private $CI;

    function Captcha()
    {
        $this->CI= & get_instance();
        $this->CI->load->driver('cache');
    }

    public function set_captcha($key, $id)
    {
        $this->CI->cache->redis->save($key, $id, 60*1);
    }

    public function get_captcha($key)
    {
        return $this->CI->cache->redis->get($key);
    }

    public function delete_captcha($key)
    {
        $this->CI->cache->redis->delete($key);
    }

}