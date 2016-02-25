<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/30
 * Time: 下午2:04
 */


/**
 *
 * @property CI_DB              $db
 * @property CI_DB_forge        $dbforge
 * @property CI_Benchmark       $benchmark
 * @property CI_Calendar        $calendar
 * @property CI_Cart            $cart
 * @property CI_Config          $config
 * @property CI_Controller      $controller
 * @property CI_Email           $email
 * @property CI_Encrypt         $encrypt
 * @property CI_Exceptions      $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Ftp             $ftp
 * @property CI_Hooks           $hooks
 * @property CI_Image_lib       $image_lib
 * @property CI_Input           $input
 * @property CI_Loader          $load
 * @property CI_Log             $log
 * @property CI_Model           $model
 * @property CI_Output          $output
 * @property CI_Pagination      $pagination
 * @property CI_Parser          $parser
 * @property CI_Profiler        $profiler
 * @property CI_Router          $router
 * @property CI_Session         $session
 * @property CI_Table           $table
 * @property CI_Trackback       $trackback
 * @property CI_Typography      $typography
 * @property CI_Unit_test       $unit_test
 * @property CI_Upload          $upload
 * @property CI_URI             $uri
 * @property CI_User_agent      $user_agent
 * @property CI_Xmlrpc          $xmlrpc
 * @property CI_Xmlrpcs         $xmlrpcs
 * @property CI_Zip             $zip
 *
 * @property Api_key            $api_key
 * @property Result             $result
 * @property Util               $util
 * @property Captcha            $captcha
 * @property param_validation   $param_validation
 * @property UserModel          $userModel
 * @property CouponModel        $couponModel
 * @property AdminModel         $adminModel
 * @property CoachModel         $coachModel
 * @property FeedbackModel      $feedbackModel
 *
 */
class MY_API_Controller extends CI_Controller {

    public $result;
    public $params;
    public $id;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('param_validation');
        $this->load->library('api_key');
        $this->result = new Result();
        $this->result->code = 100;
        $this->result->msg = '正常';
//        $this->id = -1;
        $request = $this->uri->slash_segment(4).$this->uri->segment(5);
//        if ( ! in_array($request, $this->config->item('exception')))
//            $this->id = $this->api_key->get_key('api_key:' . $this->input->get_request_header('api_key'));
        $this->params = array();
        $rule = $this->config->
        item('param_rule')[$request];
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

    public function responseWithCustom($code, $msg)
    {
        $this->code = $code;
        $this->msg = $msg;
        $this->response();
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