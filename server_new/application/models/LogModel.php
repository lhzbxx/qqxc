<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/7
 * Time: 下午2:27
 */

class LogModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Util');
    }

    public function send_log($params)
    {
        $params['create_time'] = time();
        $this->db->insert('log', $params);
    }

    public function list_log($page = 0)
    {
        $num = 10;
        return $this->db->get('log', $num, $num * $page)->result();
    }

}