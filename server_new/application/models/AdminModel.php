<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/8
 * Time: 下午11:40
 */

class AdminModel extends MY_Model {

    function __construct()
    {
        parent::__construct();
    }


    public function register($params)
    {
        $this->insert_whole_params('admin', $params);
    }

    public function login($params)
    {

    }

}