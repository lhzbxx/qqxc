<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/1/1
 * Time: 8:15
 */
class Coach_comment extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('base_tool');
    }

    public function add_comment_post()
    {
        $param = array(
            'openid'        => (string) $this->post('openid'),
            'coach_id'      => (int) $this->post('coach_id'),
            'content'       => (string) $this->post('content'),
            'star'          => (int) $this->post('star'),
            'create_time'   => (string) $this->post('create_time'),
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        if (!preg_match('/^[12345]$/', $param['star']))
        {
            $response['code']       = '201';
            $response['message']    = 'Illegal star given.';
            $this->response($response);
        }

        $this->load->model('Coach_model');

        if (!$this->Coach_model->valid_id($param['coach_id']))
        {
            $response['code']       = '202';
            $response['message']    = 'Illegal coach ID.';
            $this->response($response);
        }

        $this->load->model('User_model');

        if (!$this->User_model->valid_openid($param['openid']))
        {
            $response['code']       = '203';
            $response['message']    = 'Illegal user openID.';
            $this->response($response);
        }

        $user_id = $this->User_model->get_user_id_by_openid($param['openid']);

        if ($this->Coach_model->valid_coach_user($param['coach_id'], $user_id))
        {
            $response['code']       = '204';
            $response['message']    = 'No auth to comment.';
            $this->response($response);
        }

        $this->Coach_model->add_comment($user_id, $param['coach_id'], $param['content']);

        $this->response($response);
    }

    public function list_comment_post()
    {
        $param = array(
            'coach_id'  => (string) $this->post('coach_id'),
            'page'      => (int) $this->post('page')
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        if ($param['page'] == '')
            $param['page'] = 0;

        $this->load->model('Coach_model');

        $response['data'] = $this->Coach_model->list_comment($param['coach_id'], $param['page']);

        $this->response($response);
    }

}