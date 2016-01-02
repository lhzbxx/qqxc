<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/1/2
 * Time: 12:29
 */
class Coupon_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('base_tool');
    }

    public function add_coupon($user_id)
    {
        $coupon_str = random_str(6);
        return $coupon_str;
    }

    public function get_coupon_id($phone, $captcha)
    {
        $query = $this->db->get_where('user_info',
            array('openid' => $openid),
            1);
        $result = $query->row();
        return $result->user_id;
    }

    public function valid_coupon($user_id, $captcha)
    {
        $user_id = $this->get_user_id($phone);
        $query = $this->db->get_where('coupon',
            array(
                'phone'     => $phone,
                'captcha'   => $captcha,
            ),
            1);
        if (count($query->result()))
            return false;
        else
            return true;
    }

    public function valid_coupon($coupon_id, $phone)
    {
        $user_id = $this->get_user_id($phone);
        $query = $this->db->get_where('coupon',
            array(
                'phone' => $phone,
                'coupon_id' => $coupon_id,
            ),
            1);
        if (count($query->result()))
            return false;
        else
            return true;
    }

    public function valid_user($user_id)
    {

    }

    public function check_coupon($user_id, $coupon_id, $phone)
    {
        $valid = $this->valid_coupon($coupon_id, $phone);
        if (!$valid)
            return false;
        $valid = $this->valid_user($user_id);
        if (!$valid)
            return false;
        $data = array(
            'coupon_id' => $coupon_id,
            'user_id2'  => $user_id,
            'state'     => 1,
        );
        $this->db->update('coupon', $data);
    }

}