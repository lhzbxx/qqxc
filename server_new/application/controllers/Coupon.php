<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/31
 * Time: 下午1:10
 */

class Coupon extends MY_API_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('couponModel');
    }


    /**
     *
     * 查看个人邀请码
     *
     * @author: LuHao
     */
    public function check_code()
    {
        $this->result->data =
            $this->couponModel->check_code();
        $this->response();
    }

    /**
     *
     * 使用邀请码
     *
     * @author: LuHao
     */
    public function submit_code()
    {
        $code = $this->params['code'];
        if ($this->couponModel->valid_user())
            $this->responseWithCustom(301, '已经领取邀请码');
        if ( ! $this->couponModel->valid_coupon($code))
            $this->responseWithCustom(302, '无效邀请码');
        $this->couponModel->use_coupon($code);
        $this->response();
    }

}
