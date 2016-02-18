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
     * 列出教练
     *
     * @param $page
     * @param $query
     * @return mixed
     * @author: LuHao
     */
    public function list_coach($params)
    {
        $page = $params['page'];
        $query = $params['query'];
        switch ($query)
        {
            case 0:
                break;
            case 1:
                break;
            default:
                break;
        }
        return $this->select_page_results(
            'coach', $array, $page);
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