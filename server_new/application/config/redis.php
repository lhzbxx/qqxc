<?php
/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 16/1/30
 * Time: 下午8:08
 */

$config['socket_type'] = 'tcp'; //`tcp` or `unix`
$config['socket'] = '/var/run/redis.sock'; // in case of `unix` socket type
$config['host'] = '120.27.194.121';
$config['password'] = NULL;
$config['port'] = 6379;
$config['timeout'] = 0;