<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
//$route['404_override'] = 'Error404';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// todo: 设定接口的路由.

$route['api/([a-z]+)/(\d+)/coupon/check_code']['get'] = 'coupon/check_code';
$route['api/([a-z]+)/(\d+)/coupon/submit_code']['post'] = 'coupon/submit_code';

$route['api/admin/(\d+)/feedback/list']['get'] = 'feedback/list_fb';
$route['api/([a-z]+)/(\d+)/feedback/send']['post'] = 'feedback/send_fb';

$route['api/([a-z]+)/(\d+)/common/request_captcha_code']['post'] = 'common/request_captcha_code';

$route['api/([a-z]+)/(\d+)/user/update_location']['post'] = 'user/update_location';
$route['api/([a-z]+)/(\d+)/user/bind_wx']['post'] = 'user/bind_wx';
$route['api/([a-z]+)/(\d+)/user/avatar']['get'] = 'user/fetch_avatar';
$route['api/([a-z]+)/(\d+)/user/check_balance']['get'] = 'user/check_balance';

$route['api/wx/(\d+)/wechat/redirect']['post'] = 'wechat/redirect';
$route['api/wx/(\d+)/wechat/openid']['get'] = 'wechat/openid';
$route['api/wx/(\d+)/wechat/is_binded']['get'] = 'wechat/is_binded';
$route['api/wx/(\d+)/wechat/login']['post'] = 'wechat/login';
$route['api/wx/(\d+)/wechat/city']['get'] = 'wechat/city';
$route['api/wx/(\d+)/wechat/config']['get'] = 'wechat/config';

$route['api/wx/(\d+)/order/pay_notify']['get'] = 'order/pay_notify';
$route['api/wx/(\d+)/order/check_pay']['post'] = 'order/check_pay_state';

$route['api/([a-z]+)/(\d+)/coach/list']['get'] = 'coach/list_coach';
$route['api/([a-z]+)/(\d+)/coach/detail']['get'] = 'coach/detail';

$route['api/([a-z]+)/(\d+)/order/prepay']['get'] = 'order/prepay';