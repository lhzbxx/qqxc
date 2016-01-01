<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/1/1
 * Time: 8:13
 */
class Exercise_model extends CI_Model
{

    /**
     *
     * 添加一道正确的记录
     *
     * @param $serial_number
     * @author LuHao
     */
    public function add_right_num($serial_number)
    {
        $result = $this->is_exist($serial_number);
        if ($result)
        {
            $data = array(
                'serial_number' => $serial_number,
                'right_num'     => $result->right_num+1,
            );
            $this->db->update('exercise', $data);
        }
        else
        {
            $data = array(
                'serial_number' => $serial_number,
                'right_num'     => 6,
            );
            $this->db->insert('exercise', $data);
        }
    }

    /**
     *
     * 添加一道错误的记录
     *
     * @param $serial_number
     * @author LuHao
     */
    public function add_wrong_num($serial_number)
    {
        $result = $this->is_exist($serial_number);
        if ($result)
        {
            $data = array(
                'serial_number' => $serial_number,
                'wrong_num'     => $result->wrong_num+1,
            );
            $this->db->update('exercise', $data);
        }
        else
        {
            $data = array(
                'serial_number' => $serial_number,
                'wrong_num'     => 1,
            );
            $this->db->insert('user_info', $data);
        }
    }

    /**
     *
     * 某道题是否存在于数据库记录中
     *
     * @param $serial_number
     * @return mixed
     * @author LuHao
     */
    public function is_exist($serial_number)
    {
        $query = $this->db->get_where('exercise',
            array('serial_number' => $serial_number),
            1);
        if (count($query->result()))
            return $query->result();
        else
            return false;
    }

}