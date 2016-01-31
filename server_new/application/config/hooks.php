<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

/*
 * APIKey校验
 */
$hook['post_controller_constructor'][] = array(
    'class'     => 'Validation',
    'function'  => 'authentication',
    'filename'  => 'Validation.php',
    'filepath'  => 'hooks'
);

/*
 * 时间戳&签名校验
 */
$hook['post_controller_constructor'][] = array(
    'class'     => 'Validation',
    'function'  => 'valid',
    'filename'  => 'Validation.php',
    'filepath'  => 'hooks'
);

/*
 * 黑名单
 */
$hook['post_controller_constructor'][] = array(
    'class'     => 'Blacklist',
    'function'  => 'entrance',
    'filename'  => 'Blacklist.php',
    'filepath'  => 'hooks'
);

/*
 * Log
 */
$hook['post_controller'][] = array(
    'class'     => 'Log',
    'function'  => 'entrance',
    'filename'  => 'Log.php',
    'filepath'  => 'hooks'
);