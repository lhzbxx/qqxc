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
     * @param $lat
     * @param $lng
     * @return mixed
     * @author: LuHao
     */
    public function list_coach_auto($page, $lat, $lng)
    {
        // todo: 进行权重计算, 暂时没有做.
        $this->db->select('name, avatar_url, exp, coach_price.car_type,
         coach_price.price, coach_site.address, coach_site.lat, coach_site.lng');
        $this->db->from('coach_info');
        $this->db->join('coach_price', 'coach_price.coach_id = coach_info.coach_id', 'inner');
        $this->db->join('coach_site', 'coach_site.coach_id = coach_info.coach_id', 'inner');
        $this->db->where('city', $this->util->locate_city($lat, $lng));
        $this->db->order_by('abs(coach_site.lat-' + $lat + ')+abs(coach_site.lng -' + $lng + ')', 'desc');
        $this->db->limit(10);
        $this->db->offset(10 * $page);
        $row = $this->db->get()->result_array();
        foreach ($row as &$r)
            $r['distance'] = $this->util->dis($lat, $lng, $r['lat'], $r['lng']);
        return $row;
    }

    /**
     *
     * 按距离查询教练
     *
     * @param $page
     * @param $lat
     * @param $lng
     * @return mixed
     * @author: LuHao
     */
    public function list_coach_dis($page, $lat, $lng)
    {
        // todo: 可以先做一个初步的过滤, 暂时没有做.
        $this->db->select('name, avatar_url, exp, coach_price.car_type,
         coach_price.price, coach_site.address, coach_site.lat, coach_site.lng');
        $this->db->from('coach_info');
        $this->db->join('coach_price', 'coach_price.coach_id = coach_info.coach_id', 'inner');
        $this->db->join('coach_site', 'coach_site.coach_id = coach_info.coach_id', 'inner');
        $this->db->where('city', $this->util->locate_city($lat, $lng));
        $this->db->order_by('abs(coach_site.lat-' + $lat + ')+abs(coach_site.lng -' + $lng + ')', 'desc');
        $this->db->limit(10);
        $this->db->offset(10 * $page);
        $row = $this->db->get()->result_array();
        foreach ($row as &$r)
            $r['distance'] = $this->util->dis($lat, $lng, $r['lat'], $r['lng']);
        return $row;
    }

    /**
     *
     * 按价格查询教练
     *
     * @param $page
     * @author: LuHao
     */
    public function list_coach_price($page, $lat, $lng)
    {
        $this->db->select('name, avatar_url, exp, coach_price.car_type,
         coach_price.price, coach_site.address, coach_site.lat, coach_site.lng');
        $this->db->from('coach_info');
        $this->db->join('coach_price', 'coach_price.coach_id = coach_info.coach_id', 'inner');
        $this->db->join('coach_site', 'coach_site.coach_id = coach_info.coach_id', 'inner');
        $this->db->where('city', $this->util->locate_city($lat, $lng));
        $this->db->order_by('price', 'desc');
        $this->db->limit(10);
        $this->db->offset(10 * $page);
        $row = $this->db->get()->result_array();
        foreach ($row as &$r)
            $r['distance'] = $this->util->dis($lat, $lng, $r['lat'], $r['lng']);
        return $row;
    }

    /**
     *
     * 确认用户的城市
     *
     * @return bool
     * @author: LuHao
     */
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