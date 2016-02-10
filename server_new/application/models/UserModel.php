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
        return $this->generate_api_key('user', $this->id);
    }

    public function bind_wx($params)
    {
        $phone = $params['phone'];
        $openid = $params['openid'];
    }

    public function init_wx($params)
    {
        $this->insert_whole_params('user_info', $params);
    }

    public function login($params)
    {

    }

    public function add_balance($amount)
    {

    }

}