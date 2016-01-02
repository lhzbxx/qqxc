<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/1/2
 * Time: 11:59
 */
class Order_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_order($user_id)
    {

    }

    public function add_order_specific_coach($user_id, $coach_id)
    {

    }

}