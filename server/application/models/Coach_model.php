<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2015/12/21
 * Time: 16:42
 */
class Coach_model extends CI_Model
{
    public $name;
    public $avatar;
    public $seniority;
    public $star;
    public $type;
    public $driving;
    public $rate2;
    public $rate3;
    public $feature;
    public $address1;
    public $address2;
    public $phone;

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function insert_coach()
    {
        $this->name = $this->input->post('name');
    }

    public function delete_coach()
    {

    }
    public function update_coach()
    {

    }
    public function select_coach()
    {
        $query = $this->
    }

}