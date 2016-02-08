<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/7
 * Time: 下午3:10
 */

class CoachModel extends MY_Model {

    function __construct()
    {
        parent::__construct();
    }


    public function register($params)
    {
        $this->insert_whole_params('coach', $params);
    }

    public function login($params)
    {

    }

}