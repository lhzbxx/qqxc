<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Order extends REST_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index_get()
	{
//		$this->load->view('welcome_message');
		$this->response('hello world');
	}

	public function index_post()
	{
		$this->response('Congratulations!');
	}
}
