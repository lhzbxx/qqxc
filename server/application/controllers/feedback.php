<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2015/12/29
 * Time: 6:16
 */
class Feedback extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('base_tool');
        header('Access-Control-Allow-Origin: *');
    }

    public function send_post()
    {
        $param = array(
            'phone'         => (string) $this->post('phone'),
            'content'       => (string) $this->post('content')
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        if ($param['content'] == '')
        {
            $response['code']       = '201';
            $response['message']    = 'Blank content.';
            $this->response($response);
        }

        $this->load->model('Feedback_model');

        $this->Feedback_model->send($param['content'], $param['phone']);

        $this->response($response);
    }

    public function list_post()
    {
        $param = array(
            'openid'    => (string) $this->post('openid'),
            'page'      => (int) $this->post('page')
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        if ($param['page'] == '')
            $param['page'] = 0;

        $this->load->model('Feedback_model');

        $response['data'] = $this->Feedback_model->list_feedback($param['page']);

        $this->response($response);
    }

}