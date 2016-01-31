<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/31
 * Time: 下午6:09
 */
class CouponModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function add_coupon($params)
    {
        $this->db->insert('coupon', $params);
    }

    public function use_coupon($param)
    {

    }

}
