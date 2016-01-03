<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/1/1
 * Time: 6:09
 */
class Log_model extends CI_Model
{
    public $IP_addr;
    public $name;
    public $action;
    public $content;
    public $create_time;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_log($IP_addr, $name, $action, $remark = '', $level, $content)
    {
        $data = array(
            'IP_addr'       => $IP_addr,
            'name'          => $name,
            'action'        => $action,
            'content'       => $content,
            'remark'        => $remark,
            'level'         => $level,
            'create_time'   => date_timestamp_get(new DateTime()),
        );
        $this->db->insert('log', $data);
    }

}