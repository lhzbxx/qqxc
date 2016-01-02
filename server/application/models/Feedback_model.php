<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2015/12/29
 * Time: 6:13
 */
class Feedback_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function send($content, $phone = '')
    {
        $data = array(
            'content'       => $content,
            'phone'         => $phone,
            'create_time'   => date_timestamp_get(new DateTime())
        );
        $this->db->insert('feedback', $data);
    }

    public function list_feedback($page = 0)
    {
        $num = $this->config->item('feedback_num_per_page');
        return $this->db->get('feedback', $num, $num * $page)->result();
    }

}