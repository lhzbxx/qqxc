<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2015/12/29
 * Time: 6:16
 */
class feedback extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function feedback_post()
    {
        $param = array(
            'phone'         => (string) $this->post('phone'),
            'content'       => (string) $this->post('content'),
            'create_time'   => (string) $this->post('create_time'),
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

        $this->Feedback_model->feedback($param['content'], $param['phone']);

        $this->response($response);
    }

}