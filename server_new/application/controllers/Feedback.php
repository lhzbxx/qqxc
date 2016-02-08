<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2015/12/29
 * Time: 6:16
 */

class Feedback extends MY_API_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('FeedbackModel');
    }

    /**
     *
     * 提交反馈
     *
     * @author: LuHao
     */
    public function send_fb()
    {
        $this->Param_validation->valid_null(
            $this->params['content'], 301, '内容为空');
        $this->FeedbackModel->send_fb($this->params);
        $this->response();
    }

    /**
     *
     * 反馈列表
     *
     * @author: LuHao
     */
    public function list_fb()
    {
        $this->result->data =
            $this->FeedbackModel->list_fb($this->params['page']);
        $this->response();
    }

}