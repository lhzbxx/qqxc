<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/7
 * Time: 下午3:10
 */

class UserModel extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('util');
        $this->load->library('api_key');
    }

    /**
     *
     * 传统注册方式, 利用手机号直接注册.
     *
     * @param $params
     * @return string
     * @author: LuHao
     */
    public function register($params)
    {
        return $this->generate_api_key('user', $this->id);
    }

    /**
     *
     * 限制很小的添加用户方法, 只处理用户信息表.
     *
     * @param $params
     * @author: LuHao
     */
    public function add_user($params)
    {
        $params['register_time'] = time();
        $this->db->insert('user_info', $params);
    }

    /**
     *
     * 限制很小的更新用户信息的方法, 只处理用户信息表.
     *
     * @param $params
     * @author: LuHao
     */
    public function update_user($params, $filter)
    {
        $params['create_time'] = time();
        $this->db->update('user_info', $params, $filter, 1);
    }

    /**
     *
     * 返回用户头像
     *
     * @param $id
     * @return mixed
     * @author: LuHao
     */
    public function fetch_avatar()
    {
        $id = $this->id;
        $row = $this->select_one_result('user_info', array('user_id' => $id));
        return $row->avatar;
    }

    /**
     *
     * 绑定用户微信
     *
     * @param $phone
     * @param $pwd
     * @param $openid
     * @author: LuHao
     */
    public function bind_wx($phone, $pwd, $openid, $realname)
    {
        $salt = $this->util->random_str(16);
        $params = array(
            'account' => $phone,
            'pwd'   => $pwd,
            'salt'  => $salt
        );
        $this->db->insert('user', $params);
        $uid = $this->db->insert_id();
        $params = array(
            'user_id' => $uid,
            'realname' => $realname
        );
        $this->db->where('wx_openid', $openid);
        $this->db->update('user_info', $params);
        $this->api_key->set_key('api_key:' . $openid, $uid, 60*60*24*30*12);
    }

    /**
     *
     * 微信尝试用openid登录
     *
     * @param $openid
     * @return bool
     * @author: LuHao
     */
    public function wx_login($openid)
    {
        $row = $this->select_one_result('user_info', array('wx_openid' => $openid));
        if (isset($row) && $row->user_id)
            $this->api_key->set_key('api_key:' . $openid, $row->user_id, 60*60*24*30*12);
//        return $this->api_key->get_key('api_key:' . $openid);
    }

    /**
     *
     * 用户是否绑定微信号
     *
     * @param $openid
     * @return bool
     * @author: LuHao
     */
    public function is_wx_binded($openid)
    {
        $row = $this->select_one_result('user_info', array('wx_openid' => $openid));
        return (isset($row) && $row->user_id);
    }


    public function login($params)
    {

    }

    /**
     *
     * 添加余额
     *
     * @param $amount
     * @author: LuHao
     */
    public function add_balance($amount=200)
    {
        $this->check_balance();

    }

    /**
     *
     * 查看余额
     *
     * @return int
     * @author: LuHao
     */
    public function check_balance()
    {
        $row = $this->select_one_result('account', array(
            'cid' => $this->id, 'type' => 'U'
        ));
        if ( ! isset($row))
        {
            $params = array(
                'cid'   => $this->id,
                'type'  => 'U'
            );
            $this->db->insert('account', $params);
            return 0;
        }
        else
            return $row->balance;
    }

    /**
     *
     * 更新地理位置
     *
     * @param $uid
     * @param $lng
     * @param $lat
     * @author: LuHao
     */
    public function update_location($lng, $lat)
    {
        $uid = $this->id;
        $data = array(
            'lat' => $lat,
            'lng' => $lng
        );
        $this->db->where('user_id', $uid);
        $this->db->update('user_info', $data);
    }


}