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
    public function add_coupon($params)
    {
        $this->db->insert('coupon', $params);
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
        if ($this->valid_user($this->id))
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
    private function valid_user()
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
    private function valid_coupon($params)
    {
        $array = array(
            'state' => 1,
            'code' => $params['code'],
        );
        return $this->select_one_result('coupon', $array);
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
            return $row->code;
        } else {
            $this->add_coupon($this->id);
        }
    }

}
