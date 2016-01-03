<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/1/1
 * Time: 8:13
 */
class Exercise_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
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
        $row = $query->row();
        if (isset($row))
            return $row;
        else
            return false;
    }

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
            $this->db->insert('exercise', $data);
        }
    }

    public function right_rate($serial_number)
    {
        $query = $this->db->get_where('exercise',
            array('serial_number' => $serial_number),
            1);
        $row = $query->row();
        if (isset($row))
            return $row->right_num/($row->right_num+$row->wrong_num);
        else
        {
            $data = array(
                'serial_number' => $serial_number,
            );
            $this->db->insert('exercise', $data);
            return 1.0;
        }
    }

    /**
     *
     * 检查某个人是否之前有过记录
     *
     * @param $user_id
     * @return bool
     * @author LuHao
     */
    public function is_record($user_id)
    {
        $query = $this->db->get_where('exercise',
            array('user_id' => $user_id),
            1);
        $row = $query->row();
        if (isset($row))
            return true;
        else
            return false;
    }

    /**
     *
     * 同步历史记录
     *
     * @param $user_id
     * @param $content
     * @author LuHao
     */
    public function exercise_sync($user_id, $content)
    {
        $result = $this->is_record($user_id);
        if (!$result)
        {
            $data = array(
                'user_id'           => $user_id,
                'history'           => $content,
                'last_sync_time'    => date_timestamp_get(new DateTime())
            );
            $this->db->insert('exercise_sync', $data);
        }
        else
        {
            $data = array(
                'user_id'           => $user_id,
                'history'           => $content,
                'last_sync_time'    => date_timestamp_get(new DateTime())
            );
            $this->db->update('exercise_sync', $data);
        }
    }

}