<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/30
 * Time: 下午2:37
 */

class Validation {

    private $CI;
    private $platform;
    private $version;
    private $request;
    private $timestamp;
    private $sign;
    private $api_key;

    function Validation()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('api_key');
        $this->CI->load->library('util');
        $this->platform = $this->CI->uri->segment(2, 0);
        $this->version = $this->CI->uri->segment(3, 0);
        $this->request = $this->CI->uri->slash_segment(4) . $this->CI->uri->segment(5);
        $this->timestamp = $this->CI->input->get_request_header('timestamp', TRUE);
        $this->sign = $this->CI->input->get_request_header('sign', TRUE);
        $this->api_key = $this->CI->input->get_request_header('api_key', TRUE);
        if ( ! ($this->platform && $this->version && $this->request)
            && $this->CI->uri->segment(1, 0) != 'cli') {
            $result = $this->CI->util->result(204);
            $this->CI->util->response($result);
        }

    }

    /**
     *
     * 检查平台
     *
     * @author: LuHao
     */
    private function check_platform()
    {
        if ( ! in_array($this->platform, $this->CI->config->item('platform')))
        {
            $result = $this->CI->util->result(204);
            $this->CI->util->response($result);
        }
    }

    /**
     *
     * 检查API版本
     *
     * @author: LuHao
     */
    private function check_version()
    {
        if ($this->version != $this->CI->config->item('version')[(string)$this->request])
        {
            $result = $this->CI->util->result(206);
            $this->CI->util->response($result);
        }
    }

    /**
     *
     * 验证时间戳
     *
     * @author: LuHao
     */
    public function valid_timestamp()
    {
        if ( ! $this->CI->util->valid_time($this->timestamp))
        {
            $result = $this->CI->util->result(208);
            $this->CI->util->response($result);
        }
    }

    /**
     *
     * 验证签名
     *
     * @author: LuHao
     */
    public function valid_sign()
    {
        $rule = $this->CI->config->
        item('param_rule')[$this->CI->uri->slash_segment(4).$this->CI->uri->segment(5)];
        foreach($rule as $i)
        {
            $params[$i] = $this->CI->input->get_post($i);
        }
        $params['timestamp'] = $this->timestamp;
        $params['api_key'] = $this->api_key;
        if ( ! $this->CI->util->valid_sign($params, $this->sign))
        {
            $result = $this->CI->util->result(207);
            $result->data = $this->CI->util->sign($params);
            $this->CI->util->response($result);
        }
    }

    /**
     *
     * 参数验证
     *
     * @author: LuHao
     */
    public function valid_param()
    {
        $rule = $this->CI->config->item('param_rule')[$this->request];
        foreach ($rule as $i)
        {
            if (is_null($this->CI->input->get_post($i)))
            {
                $result = $this->CI->util->result(202);
                $this->CI->util->response($result);
            }
        }
    }

    /**
     *
     * 验证时间戳和签名值
     *
     * @author: LuHao
     */
    public function valid()
    {
        if ($this->CI->uri->segment(1, 0) == 'cli')
            return;
        $this->valid_param();
        if ($this->platform == 'wx')
        {
            return;
        }
        else
        {
            $this->valid_timestamp();
            $this->valid_sign();
        }
    }

    /**
     *
     * 验证权限
     *
     * @author: LuHao
     */
    public function authentication()
    {
        if ($this->CI->uri->segment(1, 0) == 'cli')
            return;
        $this->check_platform();
        $this->check_version();
        if (in_array($this->request, $this->CI->config->item('exception')))
        {
            return;
        }
        else
        {
            if ( ! $this->CI->api_key->get_key('api_key:' . $this->api_key))
            {
                $result = $this->CI->util->result(203);
                $this->CI->util->response($result);
            }
            if ($this->platform == 'admin')
            {
                // 权限验证.
                if ($this->CI->api_key->get_key('auth:' . $this->api_key)
                    < $this->CI->config->item('admin_auth')[(string)$this->request])
                {
                    $result = $this->CI->util->result(209);
                    $this->CI->util->response($result);
                }
            }
        }
    }

}