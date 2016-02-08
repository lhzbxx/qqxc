<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/30
 * Time: 下午2:38
 */

class Blacklist {

    private $CI;

    function Blacklist()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('Util');
    }

    /**
     *
     * 封禁IP
     *
     * @param $ip
     * @author: LuHao
     */
    public function block($ip)
    {
        // 封禁10秒.
        $this->CI->cache->redis->save('block'.$ip, true, 10);
        $result = $this->CI->util->result(205);
        $this->CI->util->response($result);
    }

    /**
     *
     * 封禁结果
     *
     * @author: LuHao
     */
    private function show()
    {
        $result = $this->CI->util->result(205);
        $this->CI->util->response($result);
    }

    /**
     *
     * 查看IP是否在黑名单
     *
     * @param $ip
     * @author: LuHao
     */
    public function check($ip)
    {
        // 如果5秒内访问次数超过100,则对IP封禁.
        if ($this->CI->cache->redis->get('block'.$ip))
        {
            $this->show();
        }
        else
        {
            if ($this->CI->cache->redis->get('visit'.$ip))
            {
                if ($this->CI->cache->redis->get('visit'.$ip) <= 100)
                    $this->CI->cache->redis->increment('visit'.$ip);
                else
                    $this->block($ip);
            }
            else
                $this->CI->cache->redis->save('visit'.$ip, 1, 5);
        }
    }

    /**
     *
     * 黑名单入口
     *
     * @author: LuHao
     */
    public function entrance()
    {
        $ip = $this->CI->input->ip_address();
        $this->check($ip);
    }

}