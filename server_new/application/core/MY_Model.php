<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/2/8
 * Time: 下午9:34
 */

/**
 *
 * @property CI_DB $db
 * @property CI_DB_forge $dbforge
 * @property CI_Benchmark $benchmark
 * @property CI_Calendar $calendar
 * @property CI_Cart $cart
 * @property CI_Config $config
 * @property CI_Controller $controller
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Exceptions $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Ftp $ftp
 * @property CI_Hooks $hooks
 * @property CI_Image_lib $image_lib
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Log $log
 * @property CI_Model $model
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Parser $parser
 * @property CI_Profiler $profiler
 * @property CI_Router $router
 * @property CI_Session $session
 * @property CI_Table $table
 * @property CI_Trackback $trackback
 * @property CI_Typography $typography
 * @property CI_Unit_test $unit_test
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $user_agent
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 * @property CI_Zip $zip
 *
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
        $query = $this->db->get_where($table,
            $array, 1);
        $row = $query->row();
        return $row;
    }

    /**
     *
     * 生成api_key
     *
     * @param $prefix
     * @param $val
     * @param $length
     * @return string
     * @author: LuHao
     */
    public function generate_api_key($prefix, $val, $length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz
        ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $api_key = '';
        for ( $i = 0; $i < $length; $i++ )
            $api_key .= $chars[ rand(0, strlen($chars) - 1) ];
        $this->api_key->set_key($prefix.$api_key, $val);
        return $api_key;
    }

}