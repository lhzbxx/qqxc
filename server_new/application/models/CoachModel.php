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


    /**
     *
     * 注册教练
     *
     * @param $params
     * @return bool
     * @author: LuHao
     */
    public function register($params)
    {
        $this->insert_whole_params('coach', $params);
        return true;
    }

    public function login($params)
    {
    }

    /**
     *
     * 智能查询教练
     *
     * @param $page
     * @author: LuHao
     */
    public function list_coach_auto($page)
    {
        $row = $this->db->where();
    }

    /**
     *
     * 按距离查询教练
     *
     * @param $page
     * @author: LuHao
     */
    public function list_coach_dis($page)
    {
        $row = $this->db->where('city', );
    }

    public function confirm_city()
    {
        $row = $this->select_one_result('user_info',
            array('user_id' => $this->id));
        if (isset($row) && $row->city)
            return $row->city;
        else
            return false;
    }

    /**
     *
     * 按价格查询教练
     *
     * @param $page
     * @author: LuHao
     */
    public function list_coach_price($page)
    {
        $row = $this->db->where();
    }

    /**
     *
     * 查看某个教练详情
     *
     * @param $params
     * @return mixed
     * @author: LuHao
     */
    public function valid_coach($params)
    {
        $array = array(
            'coach_id' => $params['coach_id']
        );
        return $this->select_one_result('coach', $array);
    }

    public function coach_photos($params)
    {
        $array = array(
            'coach_id' => $params['coach_id']
        );
        return $this->select_all_results(
            'coach', $array);
    }

}