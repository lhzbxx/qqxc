<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/1/1
 * Time: 8:13
 */
class Exercise extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('base_tool');
    }

    public function add_right_post()
    {
        $param = array(
            'serial_number' => (int) $this->post('serial_number')
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        $this->load->model('Exercise_model');

        $this->Exercise_model->add_right_num($param['serial_number']);

        $this->response($response);
    }

    public function add_wrong_post()
    {
        $param = array(
            'serial_number' => (int) $this->post('serial_number')
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        $this->load->model('Exercise_model');

        $this->Exercise_model->add_wrong_num($param['serial_number']);

        $this->response($response);
    }

    public function get_right_rate_post()
    {
        $param = array(
            'serial_number' => (int) $this->post('serial_number')
        );

        $response = array(
            'code'      => '100',
            'message'   => 'OK',
            'data'      => array()
        );

        $this->load->model('Exercise_model');

        $response['data'] = $this->Exercise_model->right_rate($param['serial_number']);

        $this->response($response);
    }

}