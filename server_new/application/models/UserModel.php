<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/7
 * Time: 下午3:10
 */

class UserModel extends MY_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function register($params)
    {

    }

    public function bind_wx($params)
    {
        $phone = $params['phone'];
        $openid = $params['openid'];
    }

    public function login($params)
    {

    }

    public function add_balance($amount)
    {

    }

}