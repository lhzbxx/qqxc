<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/30
 * Time: 下午2:04
 */

class MY_API_Controller extends CI_Controller {

    public $result;
    public $params;

    public function __construct()
    {
        parent::__construct();
        $this->result = new Result();
        $this->result->code = 100;
        $this->result->msg = '正常';
        $this->params = array();
        $rule = $this->config->
        item('param_rule')[$this->uri->slash_segment(4).$this->uri->segment(5)];
        foreach($rule as $i)
        {
            $this->params[$i] = $this->input->get_post($i);
        }
    }

    public function response()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function responseWithCache()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->cache(10)
            ->_display();
        exit;
    }
}

class MY_CLI_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ( ! is_cli())
            exit();
    }

    public function response()
    {
    }

}