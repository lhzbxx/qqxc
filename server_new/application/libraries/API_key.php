<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/30
 * Time: 下午2:40
 */

class Api_key {

    private $CI;

    function API_key()
    {
        $this->CI= & get_instance();
        $this->CI->load->driver('cache');
    }

    public function set_key($key, $id, $time=10)
    {
        $this->CI->cache->redis->save($key, $id, $time);
    }

    public function get_key($key)
    {
        return $this->CI->cache->redis->get($key);
    }

    public function delete_key($key)
    {
        $this->CI->cache->redis->delete($key);
    }

}