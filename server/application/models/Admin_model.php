<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/1/1
 * Time: 8:09
 */
class Admin_model extends CI_Model
{

    /**
     *
     * 判断管理员是否满足权限
     *
     * @param $auth
     * @param $openid
     * @return bool
     * @author LuHao
     */
    public function check_auth($auth, $openid)
    {
        if ($auth >= $this->get_auth($openid))
            return true;
        else
            return false;
    }

    /**
     *
     * 验证管理员的openid
     *
     * @param $openid
     * @return bool
     * @author LuHao
     */
    public function valid_openid($openid)
    {
        $query = $this->db->get_where('admin_info',
            array('openid' => $openid),
            1);
        $result = $query->row();
        if ($result->expire > date_timestamp_get(new DateTime()))
            return true;
        else
            return false;
    }

    /**
     *
     * 通过openid获取权限值
     *
     * @param $openid
     * @return mixed
     * @author LuHao
     */
    public function get_auth($openid)
    {
        $query = $this->db->get_where('admin_info',
            array('openid' => $openid),
            1);
        $result = $query->row();
        return $result->auth;
    }

}