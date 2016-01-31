<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2015/12/29
 * Time: 6:13
 */
class FeedbackModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Util');
    }

    public function send_fb($params)
    {
        $params['create_time'] = time();
        if ( ! $this->db->insert('feedback', $params))
        {
            $result = $this->util->result(210);
            $this->util->response($result);
        }
    }

    public function list_fb($page)
    {
        $num = 10;
        return $this->db->get('feedback', $num, $num * $page)->result();
    }

}