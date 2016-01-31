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
    }

    public function check_code()
    {
        $this->response();
    }

    public function submit_code()
    {
        $this->response();
    }

}
