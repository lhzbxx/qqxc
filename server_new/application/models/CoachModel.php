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

    /**
     *
     * 查看某个教练的某个车型的详情
     *
     * @param $coach_id
     * @param $type
     * @param $lat
     * @param $lng
     * @return mixed
     * @author: LuHao
     */
    public function detail($coach_id, $type, $lat, $lng)
    {
        $result = array();
        $row = $this->select_one_result('coach_info', array('coach_id' => $coach_id));
        if ( ! isset($row))
            $this->util->response_custom(301, '教练不存在');
        $result['name'] = $row->name;
        $result['avatar_url'] = $row->avatar_url;
        $result['exp'] = $row->exp;
        $result['coach_id'] = $coach_id;
        $row = $this->select_one_result('coach_site', array('coach_id' => $coach_id));
        if ( ! isset($row))
            $this->util->response_custom(302, '教练没有该车型');
        $result['address'] = $row->address;
        $result['distance'] = (int) $this->util->dis($lat, $lng, $row->lat, $row->lng)/1000;
        $row = $this->select_one_result('coach_price', array('coach_id' => $coach_id, 'car_type' => $type));
        $result['price'] = $row->price;
        $result['car_type'] = $type;
        $result['photos'] = $this->photos($coach_id);
        return $result;
    }

    /**
     *
     * 教练的照片
     *
     * @param $coach_id
     * @return mixed
     * @author: LuHao
     */
    public function photos($coach_id)
    {
        $this->db->select('url');
        $this->db->from('photo');
        $this->db->where('cid', $coach_id);
        $this->db->where('type', 'C');
        $rows = $this->db->get()->result_array();
        return $rows;
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
        $this->db->select('name, avatar_url, exp, coach_price.car_type, coach_info.coach_id,
         coach_price.price, coach_site.address, coach_site.lat, coach_site.lng');
        $this->db->from('coach_info');
        $this->db->join('coach_price', 'coach_price.coach_id = coach_info.coach_id', 'inner');
        $this->db->join('coach_site', 'coach_site.coach_id = coach_info.coach_id', 'inner');
        $this->db->order_by('abs(coach_site.lat-' + $lat + ')+abs(coach_site.lng -' + $lng + ')', 'desc');
        $this->db->limit(10);
        $this->db->offset(10 * $page);
        $row = $this->db->get()->result_array();
        foreach ($row as &$r)
            $r['distance'] = (int) $this->util->dis($lat, $lng, $r['lat'], $r['lng'])/1000;
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
        $this->db->select('name, avatar_url, exp, coach_price.car_type, coach_info.coach_id,
         coach_price.price, coach_site.address, coach_site.lat, coach_site.lng');
        $this->db->from('coach_info');
        $this->db->join('coach_price', 'coach_price.coach_id = coach_info.coach_id', 'inner');
        $this->db->join('coach_site', 'coach_site.coach_id = coach_info.coach_id', 'inner');
        $this->db->order_by('abs(coach_site.lat-' + $lat + ')+abs(coach_site.lng -' + $lng + ')', 'desc');
        $this->db->limit(10);
        $this->db->offset(10 * $page);
        $row = $this->db->get()->result_array();
        foreach ($row as &$r)
            $r['distance'] = (int) $this->util->dis($lat, $lng, $r['lat'], $r['lng'])/1000;
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
        $this->db->select('name, avatar_url, exp, coach_price.car_type, coach_info.coach_id,
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
            $r['distance'] = (int) $this->util->dis($lat, $lng, $r['lat'], $r['lng'])/1000;
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
     * 确认某个教练是否存在
     *
     * @param $coach_id
     * @return bool
     * @author: LuHao
     */
    public function valid_coach($coach_id)
    {
        $row = $this->select_one_result('coach_info', $coach_id);
        return isset($row);
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