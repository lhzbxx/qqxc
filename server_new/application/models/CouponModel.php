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
     * @param $params
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
     * @param $params
     * @return bool
     * @author: LuHao
     */
    public function use_coupon($params)
    {
        if ($this->valid_user())
        {
            $this->util->response_custom(301, '已经使用过邀请码');
        }
        $row = $this->valid_coupon($params);
        if (isset($row))
        {
            // todo: 现金流记录
            $this->db->insert('user_coupon', $params);
            return true;
        }
        else
            return false;
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
     * @param $params
     * @return mixed
     * @author: LuHao
     */
    public function valid_coupon($params)
    {
        $array = array(
            'state' => 1,
            'coupon_code' => $params['code'],
        );
        return $this->select_one_result('coupon', $array);
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
