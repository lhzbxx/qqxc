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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api/user/login']['post']    = 'user/login';
$route['api/user/register']['post'] = 'user/register';
$route['api/user/captcha']['post']  = 'user/captcha';

$route['api/feedback/send']['post'] = 'feedback/send';
$route['api/feedback/get_list']['post'] = 'feedback/list';

$route['api/coach/add_coach']['post']        = 'coach/add_coach';
$route['api/coach/edit_coach']['post']       = 'coach/edit_coach';
$route['api/coach/change_status']['post']    = 'coach/change_status';
$route['api/coach/get_coach_detail']['post'] = 'coach/coach_detail';
$route['api/coach/get_coach_list']['post']   = 'coach/list_coach';

$route['api/coach/add_comment']['post']      = 'coach_comment/add_comment';
$route['api/coach/get_comment_list']['post'] = 'coach_comment/list_comment';

$route['api/exercise/sync']['post']         = 'exercise/exercise_sync';
$route['api/exercise/add_right']['post']    = 'exercise/add_right';
$route['api/exercise/add_wrong']['post']    = 'exercise/add_wrong';
$route['api/exercise/right_rate']['post']   = 'exercise/get_right_rate';

$route['api/test'] = 'welcome/index';
