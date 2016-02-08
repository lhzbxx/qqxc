<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/31
 * Time: 下午1:10
 */

class coupon extends MY_API_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CouponModel');
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
            $this->CouponModel->check_code($this->params);
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
        if ($this->CouponModel->valid_user())
            $this->responseWithCustom(301, '已经领取邀请码');
        if ($this->CouponModel->valid_coupon($this->params))
            $this->responseWithCustom(302, '无效邀请码');
        $this->CouponModel->use_coupon($this->params);
        $this->response();
    }

}
