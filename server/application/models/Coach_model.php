<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2015/12/21
 * Time: 16:42
 */
class Coach_model extends CI_Model
{
    public $phone;
    public $name;
    public $seniority;
    public $car_type;
    public $school;
    public $avatar;
    public $sub2pass;
    public $sub2total;
    public $sub3pass;
    public $sub3total;
    public $service;
    public $address;
    public $latitude;
    public $longitude;
    public $star_total;
    public $star_num;
    public $status;
    public $register_time;

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function add_comment($user_id, $coach_id, $content)
    {
        $data = array(
            'user_id'     => $user_id,
            'coach_id'    => $coach_id,
            'content'     => $content,
            'create_time' => date_timestamp_get(new DateTime())
        );
        $this->db->insert('coach_comment', $data);
    }

    public function list_coach($page)
    {
        $data =  $this->db->get('coach', 20, 20 * $page)->result();
        return $data;
    }
    public function list_comment($coach_id, $page)
    {
        $data =  $this->db->get_where('coach_comment', array(
            'coach_id' => $coach_id,
        ), 10, 10 * $page)->result();
        return $data;
    }

    public function get_coach_detail($coach_id)
    {
        $data =  $this->db->get_where('coach', array(
            'id' => $coach_id,
        ),1)->result();
        return $data;
    }

    public function get_coordinate($address)
    {
        // todo: get coordinate with address using baidu web api.
    }

    public function add_coach($phone, $name, $seniority, $car_type, $school, $avatar, $sub2pass, $sub2total
        , $sub3pass, $sub3total, $service, $address, $latitude, $longitude, $star_total, $star_num)
    {
        $data = array(
            'phone'         => $phone,
            'name'          => $name,
            'seniority'     => $seniority,
            'car_type'      => $car_type,
            'school'        => $school,
            'avatar'        => $avatar,
            'sub2pass'      => $sub2pass,
            'sub2total'     => $sub2total,
            'sub3pass'      => $sub3pass,
            'sub3total'     => $sub3total,
            'service'       => $service,
            'address'       => $address,
            'latitude'      => $latitude,
            'longitude'     => $longitude,
            'star_total'    => $star_total,
            'star_num'      => $star_num,
            'register_time' => date_timestamp_get(new DateTime())
        );

        // todo: auto add lat&lng with specific address.

        $this->db->insert('coach', $data);
    }

    public function edit_coach($id, $phone, $name, $seniority, $car_type, $school, $avatar, $sub2pass, $sub2total
        , $sub3pass, $sub3total, $service, $address, $latitude, $longitude, $star_total, $star_num)
    {
        $data = array(
            'id'         => $id,
            'phone'      => $phone,
            'name'       => $name,
            'seniority'  => $seniority,
            'car_type'   => $car_type,
            'school'     => $school,
            'avatar'     => $avatar,
            'sub2pass'   => $sub2pass,
            'sub2total'  => $sub2total,
            'sub3pass'   => $sub3pass,
            'sub3total'  => $sub3total,
            'service'    => $service,
            'address'    => $address,
            'latitude'   => $latitude,
            'longitude'  => $longitude,
            'star_total' => $star_total,
            'star_num'   => $star_num,
        );

        // todo: auto add lat&lng with specific address.

        $this->db->update('coach', $data);
    }

    public function valid_phone($phone)
    {
        $query = $this->db->get_where('coach',
            array('phone' => $phone),
            1);
        $row = $query->row();
        if (isset($row))
            return false;
        else
            return true;
    }

    public function valid_id($id)
    {
        $query = $this->db->get_where('coach',
            array('id' => $id),
            1);
        $row = $query->row();
        if (isset($row))
            return true;
        else
            return false;
    }

    public function change_status($id, $status)
    {
        $data = array(
            'id'     => $id,
            'status' => $status
        );
        $this->db->update('coach', $data);
    }

    public function calculate_distance($lat1, $long1, $lat2, $long2)
    {
        $distance = (2 * 6378.137 * asin(sqrt(pow(sin(pi() * ($long2 - $lat1) / 360), 2) +
                cos(pi() * $lat2 / 180) * cos($lat1 * pi() / 180) * pow(sin(pi() * ($lat2 - $long1) / 360), 2))));
        return $distance;
    }

    public function valid_coach_user($coach_id, $user_id)
    {
        $query = $this->db->get_where('coach_user',
            array(
                'coach_id'  => $coach_id,
                'user_id'   => $user_id
            ),
            1);
        $row = $query->row();
        if (isset($row))
            return true;
        else
            return false;
    }

    public function add_coach_user($coach_id, $user_id, $deal_type = 0)
    {
        $data = array(
            'coach_id'      => $coach_id,
            'user_id'       => $user_id,
            'deal_type'     => $deal_type,
            'create_time'   => date_timestamp_get(new DateTime())
        );
        $this->db->insert('coach_user', $data);
    }

}