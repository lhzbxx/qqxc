<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/9
 * Time: 下午5:08
 */

class OrderModel extends MY_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function add_order($coach_id, $car_type, $price, $pay_id)
    {
        $user_id = $this->id;
        $params = array(
            'user_id' => $user_id,
            'coach_id' => $coach_id,
            'car_type' => $car_type,
            'price' => $price,
            'pay_id' => $pay_id,
            'create_time' => time()
        );
        $this->insert_whole_params('order', $params);
    }

    public function update_paid($pay_id)
    {
        $this->db->update('order', array('state' => 'Y'),
            array('pay_id' => $pay_id));
    }

}