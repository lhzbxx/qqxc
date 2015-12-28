<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2015/12/24
 * Time: 9:28
 */
class Coach extends CI_Controller
{
    public function coach()
    {
        $this->load->model('coach');
        $data['query'] = $this->coach->list_coach();

        $this->load->view('coach', $data);
    }
}