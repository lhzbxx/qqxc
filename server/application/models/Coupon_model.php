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

    /**
     *
     * 添加一个优惠券
     *
     * @param $user_id
     * @param $discount
     * @return string
     * @author LuHao
     */
    public function add_coupon($user_id, $discount)
    {
        $coupon_str = random_str(6);
        $data = array(
            'user_id1'      => $user_id,
            'discount'      => $discount,
            'create_time'   => date_timestamp_get(new DateTime())
        );
        $this->db->insert('coach_user', $data);
        return $coupon_str;
    }

    /**
     *
     * 通过手机号和优惠码获取优惠券信息
     *
     * @param $phone
     * @param $code
     * @return bool
     * @author LuHao
     */
    public function get_coupon_id($phone, $code)
    {
        $this->load->model('User_model');
        $user_id = $this->User_model->get_user_id_by_phone($phone);
        $query = $this->db->get_where('user_info',
            array(
                'user_id1'      => $user_id,
                'coupon_code'   => $code
            ),
            1);
        $result = $query->row();
        if (isset($result))
            return $result->id;
        else
            return false;
    }

    /**
     *
     * 检查优惠券是否有效
     *
     * @param $coupon_id
     * @param $user_id
     * @return bool
     * @author LuHao
     */
    public function valid_coupon($coupon_id, $user_id)
    {
        $query = $this->db->get_where('coupon',
            array(
                'id'        => $coupon_id,
                'user_id2'  => $user_id,
                'state'     => 0,
            ),
            1);
        $result = $query->row();
        if (isset($result))
            return true;
        else
            return false;
    }

    /**
     *
     * 检查一个用户是否有资格领取优惠券
     *
     * @param $user_id
     * @param int $coupon_type
     * @return bool
     * @author LuHao
     */
    public function valid_user($user_id, $coupon_type = 0)
    {
        $query = $this->db->get_where('coupon',
            array(
                'coupon_type'   => $coupon_type,
                'user_id2'      => $user_id,
            ),
            1);
        $result = $query->row();
        if (isset($result))
            return false;
        else
            return true;
    }

    /**
     *
     * 使用优惠券
     *
     * @param $user_id
     * @param $coupon_id
     * @author LuHao
     */
    public function use_coupon($user_id, $coupon_id)
    {
        $data = array(
            'coupon_id' => $coupon_id,
            'user_id2'  => $user_id,
            'state'     => 1,
        );
        $this->db->update('coupon', $data);
    }

}