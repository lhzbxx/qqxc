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

    public function prepay($coach_id)
    {

        $params['signature'] = $this->util->wx_sign($params);
        $params['jsapi_ticket'] = '';
        $this->result->data = $params;
        $this->response();
    }

}