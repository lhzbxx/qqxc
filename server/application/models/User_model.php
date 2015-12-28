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
        $salt = random_string();
        $passwd = md5((string) $passwd.$salt);
        $data = array(
            'phone'         => $phone,
            'passwd'        => $passwd,
            'salt'          => $salt,
        );
        $this->db->insert('user', $data);
        $data = array(
            'nickname'      => $phone,
            'passwd'        => $passwd,
            'openid'        => md5($phone).random_string(),
            'register_time' => date_timestamp_get(new DateTime()),
        );
        $this->db->insert('user_info', $data);
        return $data['openid'];
    }
}