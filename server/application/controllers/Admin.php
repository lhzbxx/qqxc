<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Admin extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('base_tool');
    }

    /**
     *
     * 向特定用户群发送系统公告
     *
     * @param int $user_state
     * @param $content
     * @author LuHao
     */
    public function publish_system_notice()
    {
        // user_state
        // 0: 新用户
        // >0: 学车中
        // -1: 所有用户

        $param = array(
            'openid'        => (string) $this->post('openid'),
            'user_state'    => (string) $this->post('user_state'),
            'content'       => (string) $this->post('content'),
            'create_time'   => date_timestamp_get(new DateTime()),
        );

        $verifi = (string) $this->post('verifi');

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        $cur_time = date_timestamp_get(new DateTime());
        if (abs($param['create_time'] - $cur_time) > 60*15)
        {
            // todo: start expire validation.
            // $response['code']       = '301';
            // $response['message']    = 'Expire request.';
            // $this->response($response);
        }

        if (!$this->valid($param, $verifi))
        {
            $response['code']       = '301';
            $response['message']    = 'Illegal request.';
            $response['data']       = $this->verify($param);
            $this->response($response);
        }

        $this->load->model('User_model');

        $rows = $this->User_model->get_users_list($param['user_state']);

        foreach ($rows->result() as $row)
        {
            $this->User_model->add_notice($row->user_id, $param['content'], 'system');
        }

        $this->response($response);
    }

    /**
     *
     * 验证参数
     *
     * @param $param
     * @param $verifi
     * @return bool
     * @author LuHao
     */
    public function valid($param, $verifi)
    {
        $str = '';
        ksort($param);
        foreach ($param as $k => $v) {
            $str .= "$k=$v";
        }
        if (mb_strtoupper(md5($str)) == mb_strtoupper($verifi))
            return true;
        else
            return false;
    }

    /**
     *
     * 验证值(仅测试)
     *
     * @param $param
     * @return string
     * @author LuHao
     */
    public function verify($param)
    {
        $str = '';
        ksort($param);
        foreach ($param as $k => $v) {
            $str .= "$k=$v";
        }
        return md5($str);
    }

}