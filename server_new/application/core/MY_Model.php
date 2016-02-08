<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/8
 * Time: 下午9:34
 */

class MY_Model extends CI_Model {

    public $id;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('API_key');
        $this->load->library('Util');
        if ( ! in_array($this->request, $this->CI->config->item('exception')))
        {
            $api_key = $this->CI->input->get_request_header('api_key', TRUE);
            $this->id = $this->api_key->get_key($api_key);
        }
    }

    /**
     *
     * 将参数整个插入数据库中
     *
     * @param $table
     * @param $params
     * @author: LuHao
     */
    public function insert_whole_params($table, $params)
    {
        $params['create_time'] = time();
        if ( ! $this->db->insert($table, $params))
        {
            $result = $this->util->result(210);
            $this->util->response($result);
        }
    }

    /**
     *
     * 将参数整个更新数据库
     *
     * @param $table
     * @param $params
     * @author: LuHao
     */
    public function update_whole_params($table, $params)
    {
        $params['create_time'] = time();
        if ( ! $this->db->update($table, $params))
        {
            $result = $this->util->result(210);
            $this->util->response($result);
        }
    }

    /**
     *
     * 查询单个结果
     *
     * @param $table
     * @param $array
     * @return mixed
     * @author: LuHao
     */
    public function select_one_result($table, $array)
    {
        $query = $this->db->get_where('coupon',
            $array, 1);
        $row = $query->row();
        return $row;
    }

}