<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2015/12/28
 * Time: 16:38
 */
class User_model extends CI_Model
{
    public $phone;
    public $passwd;
    public $salt;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     *
     * 通过手机号和密码注册
     *
     * @param $phone
     * @param $passwd
     * @return mixed
     * @author LuHao
     */
    public function register($phone, $passwd)
    {
        $salt = $this->random_str(8);
        $passwd = md5((string) $passwd.$salt);
        $data = array(
            'phone'         => $phone,
            'passwd'        => $passwd,
            'salt'          => $salt,
        );
        $user_id = $this->db->insert('user', $data);
        $data = array(
            'phone'         => $phone,
            'user_id'       => $user_id,
            'nickname'      => '学员'.(substr(md5($phone), 0, 8)),
            'openid'        => substr(md5($phone), 0, 8).$this->random_str(5),
            'expire'        => date_timestamp_get(new DateTime()) + 60*60*24*365,
            'register_time' => date_timestamp_get(new DateTime()),
        );
        $this->db->insert('user_info', $data);
        return $data['openid'];
    }

    /**
     *
     * 验证用户的手机号
     *
     * @param $phone
     * @return bool
     * @author LuHao
     */
    public function valid_phone($phone)
    {
        $query = $this->db->get_where('user',
            array('phone' => $phone),
            1);
        if (count($query->result()))
            return false;
        else
            return true;
    }

    /**
     *
     * 验证用户的openid
     *
     * @param $openid
     * @return bool
     * @author LuHao
     */
    public function valid_openid($openid)
    {
        $query = $this->db->get_where('user_info',
            array('openid' => $openid),
            1);
        $row = $query->row();
        if (isset($row))
        {
            if ($row->expire > date_timestamp_get(new DateTime()))
                return true;
            else
                return false;
        }
        else
            return false;
    }

    /**
     *
     * 根据openid获取用户的user_id
     *
     * @param $openid
     * @return mixed
     * @author LuHao
     */
    public function get_user_id_by_openid($openid)
    {
        $query = $this->db->get_where('user_info',
            array('openid' => $openid),
            1);
        $result = $query->row();
        return $result->user_id;
    }

    /**
     *
     * 根据phone获取用户的id
     *
     * @param $phone
     * @return mixed
     * @author LuHao
     */
    public function get_user_id_by_phone($phone)
    {
        $query = $this->db->get_where('user',
            array('phone' => $phone),
            1);
        $result = $query->row();
        return $result->id;
    }

    /**
     *
     * 更新用户的openid
     *
     * @param $phone
     * @return string
     * @author LuHao
     */
    public function update_openid($phone)
    {
        if ($this->config->item('fixed_openid'))
            $openid = '526ce12fb(12GF3';
        else
            $openid = substr(md5($phone), 0, 8).$this->random_str(5);
        $data = array(
            'phone'     => $phone,
            'openid'    => $openid,
            'expire'    => date_timestamp_get(new DateTime()) + 60*60*24*365,
        );
        $this->db->update('user_info', $data);
        return $openid;
    }

    /**
     *
     * 修改用户的密码
     *
     * @param $phone
     * @param $passwd
     * @author LuHao
     */
    public function update_password($phone, $passwd)
    {
        $salt = $this->random_str(8);
        $passwd = md5((string) $passwd.$salt);
        $data = array(
            'phone'     => $phone,
            'salt'      => $salt,
            'passwd'    => $passwd,
        );
        $this->db->update('user_info', $data);
    }

    /**
     *
     * 修改用户的昵称
     *
     * @param $phone
     * @param $nickname
     * @author LuHao
     */
    public function update_nickname($phone, $nickname)
    {
        $data = array(
            'phone'     => $phone,
            'nickname'  => $nickname,
        );
        $this->db->update('user_info', $data);
    }

    /**
     *
     * 验证手机号和密码是否正确
     *
     * @param $phone
     * @param $passwd
     * @return bool
     * @author LuHao
     */
    public function check($phone, $passwd)
    {
        $query = $this->db->get_where('user',
            array('phone' => $phone),
            1);
        $result = $query->row();
        $salt = $result->salt;
        if (ctype_upper(md5($passwd.$salt)) == ctype_upper($result->passwd))
            return true;
        else
            return false;
    }

    /**
     *
     * 生成随机字符串
     *
     * @param int $length
     * @return string
     * @author LuHao
     */
    public function random_str($length = 6)
    {
        $str = '';
        for ($i = 0; $i < $length; $i++)
            $str .= chr(mt_rand(33, 126));
        return $str;
    }

    /**
     *
     * 向用户添加通知
     *
     * @param $user_id
     * @param $content
     * @param $sender
     * @author LuHao
     */
    public function add_notice($user_id, $content, $sender)
    {
        $data = array(
            'user_id'       => $user_id,
            'content'       => $content,
            'sender'        => $sender,
            'create_time'   => date_timestamp_get(new DateTime()),
        );
        $this->db->insert('user_info', $data);
    }

    /**
     *
     * 通知已读反馈
     *
     * @param $user_id
     * @author LuHao
     */
    public function remove_notice($user_id)
    {
        $data = array(
            'state'     => 0,
        );
        $this->db->update('user_notice', $data, array('user_id' => $user_id));
    }

    /**
     *
     * 拉取用户的所有未读通知
     *
     * @param $user_id
     * @return mixed
     * @author LuHao
     */
    public function pull_notice($user_id)
    {
        $result =  $this->db->get_where('user_notice', array('user_id' => $user_id, 'state' => 0));
        return $result->result();
    }

    public function get_users_list($state)
    {
        $condition = array();
        if ($state == -1)
        {
            $query = $this->db->get('user');
        }
        else
        {
            $query = $this->db->get('user', array('state' => $state));
        }
        return $query;
    }

    /**
     *
     * 获取用户账号余额
     *
     * @param $user_id
     * @return mixed
     * @author LuHao
     */
    public function get_user_balance($user_id)
    {
        $this->db->select_sum('amount');
        $query = $this->db->get_where('user_cash', array('user_id' => $user_id));
        return $query->result()->amount;
    }

    /**
     *
     * 返回用户的详细账单
     *
     * @param $user_id
     * @param $page
     * @return mixed
     * @author LuHao
     */
    public function get_user_cash_list($user_id, $page)
    {
        $query = $this->db->get_where('user_cash', array('user_id' => $user_id), 10, $page * 10);
        return $query->result();
    }

    /**
     *
     * 用户账号充值或返现
     *
     * @param $user_id
     * @param $amount
     * @param $payment
     * @author LuHao
     */
    public function recharge($user_id, $amount, $source)
    {
        $data = array(
            'user_id'       => $user_id,
            'amount'        => $amount,
            'source'        => $source,
            'create_time'   => date_timestamp_get(new DateTime()),
        );
        $this->db->insert('user_cash', $data);
        // todo: invoke payment API.
    }

    /**
     *
     * 用户账号提现或消费
     *
     * @param $user_id
     * @param $amount
     * @param $source
     * @author LuHao
     */
    public function withdraw($user_id, $amount, $source)
    {
        $data = array(
            'user_id'       => $user_id,
            'amount'        => $amount,
            'source'        => $source,
            'create_time'   => date_timestamp_get(new DateTime()),
        );
        $this->db->insert('user_info', $data);
        // todo: invoke payment API.
    }

    /**
     *
     * 更新用户的学车信息
     *
     * @param $user_id
     * @param $process
     * @author LuHao
     */
    public function update_process($user_id, $process)
    {
        $data = array(
            'user_id'   => $user_id,
            'process'   => $process,
        );
        $this->db->update('user_info', $data);
    }

}