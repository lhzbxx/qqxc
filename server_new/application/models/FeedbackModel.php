<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2015/12/29
 * Time: 6:13
 */

class FeedbackModel extends MY_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     *
     * 提交反馈
     *
     * @param $params
     * @author: LuHao
     */
    public function send_fb($params)
    {
        $this->insert_whole_params('feedback', $params);
    }

    /**
     *
     * 列出反馈
     *
     * @param $page
     * @return mixed
     * @author: LuHao
     */
    public function list_fb($page)
    {
        $num = 10;
        return $this->db->get('feedback', $num, $num * $page)->result();
    }

}