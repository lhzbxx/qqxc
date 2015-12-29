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

    public function register($phone, $passwd)
    {
        $salt = $this->random_str(8);
        $passwd = md5((string) $passwd.$salt);
        $data = array(
            'phone'         => $phone,
            'passwd'        => $passwd,
            'salt'          => $salt,
        );
        $this->db->insert('user', $data);
        $data = array(
            'phone'        => $phone,
            'nickname'      => '学员'.(substr(md5($phone), 0, 8)),
            'openid'        => substr(md5($phone), 0, 8).$this->random_str(5),
            'expire'        => date_timestamp_get(new DateTime()) + 60*60*24*365,
            'register_time' => date_timestamp_get(new DateTime()),
        );
        $this->db->insert('user_info', $data);
        return $data['openid'];
    }

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

    public function valid_openid($openid)
    {
        $query = $this->db->get_where('user_info',
            array('openid' => $openid),
            1);
        if ($query['expire'] > date_timestamp_get(new DateTime()))
            return true;
        else
            return false;
    }

    public function update_openid($phone)
    {
        $openid = substr(md5($phone), 0, 8).$this->random_str(5);
        $data = array(
            'phone'     => $phone,
            'openid'    => $openid,
            'expire'    => date_timestamp_get(new DateTime()) + 60*60*24*365,
        );
        $this->db->update('user_info', $data);
        return $openid;
    }

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

    function random_str($length = 6)
    {
        $str = '';
        for ($i = 0; $i < $length; $i++)
            $str .= chr(mt_rand(33, 126));
        return $str;
    }
}