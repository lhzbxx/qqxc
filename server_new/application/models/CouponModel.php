<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/31
 * Time: 下午6:09
 */

class CouponModel extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('Money_record');
    }

    /**
     *
     * 添加优惠券
     *
     * @param $uid
     * @return string
     * @author: LuHao
     */
    public function add_coupon($uid)
    {
        $code = $this->generate_code();
        // 验重, 保证优惠码是唯一的.
        while ($this->is_exist_coupon($code))
            $code = $this->generate_code();
        $params = array(
            'user_id'    => $uid,
            'coupon_code'  => $code,
        );
        $this->db->insert('coupon', $params);
        return $code;
    }

    /**
     *
     * 使用优惠券
     *
     * @param $code
     * @return bool
     * @author: LuHao
     */
    public function use_coupon($code)
    {
        $row = $this->select_one_result('coupon', array('coupon_code' => $code));
        $params = array(
            'user_id' => $this->id,
            'coupon_id' => $row->id
        );
        // todo: 现金流记录 & 验证优惠额度.
        $this->db->insert('user_coupon', $params);
        $this->db->set('balance', 'balance+200', false);
        $this->db->where('cid', $this->id);
        $this->db->update('account');
    }

    /**
     *
     * 查看是否是自己的优惠码
     *
     * @param $code
     * @return bool
     * @author: LuHao
     */
    public function is_self_code($code)
    {
        $row = $this->select_one_result('coupon', array('coupon_code' => $code));
        return ($this->id == $row->user_id);
    }

    /**
     *
     * 检查用户是否已领取
     *
     * @return bool
     * @author: LuHao
     */
    public function valid_user()
    {
        $array = array(
            'user_id' => $this->id,
        );
        $row = $this->select_one_result('user_coupon', $array);
        return isset($row);
    }

    /**
     *
     * 检查优惠券是否有效
     *
     * @param $code
     * @return mixed
     * @author: LuHao
     */
    public function valid_coupon($code)
    {
        $array = array(
            'coupon_code' => $code,
        );
        $row = $this->select_one_result('coupon', $array);
        return (isset($row) && $row->user_id != $this->id);
    }

    private function generate_code()
    {
        $r = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm12345678901234567890';
        $i = 6;
        $code = "";
        while ($i--)
            $code .= $r[rand(0, 72)];
        return $code;
    }

    /**
     *
     * 检查优惠码是否已经存在
     *
     * @param $code
     * @return bool
     * @author: LuHao
     */
    private function is_exist_coupon($code)
    {
        $params = array(
            'coupon_code' => $code
        );
        $row = $this->select_one_result('coupon', $params);
        return isset($row);
    }

    /**
     *
     * 查看优惠码
     *
     * @return mixed
     * @author: LuHao
     */
    public function check_code()
    {
        $array = array(
            'user_id' => $this->id
        );
        $row = $this->select_one_result('coupon', $array);
        if (isset($row)) {
            return $row->coupon_code;
        } else {
            // 如果没有优惠码, 说明没有添加, 在这里手动添加上.
            return $this->add_coupon($this->id);
        }
    }

}
