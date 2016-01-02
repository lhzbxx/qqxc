<?php

/**
 * Created by PhpStorm.
 * User: LuHao
 * Date: 2016/1/2
 * Time: 22:33
 */

/**
 *
 * 生成随机字符串
 *
 * @param int $length
 * @return string
 * @author LuHao
 */
function random_str($length = 6)
{
    $str = '';
    for ($i = 0; $i < $length; $i++)
        $str .= chr(mt_rand(33, 126));
    return $str;
}

/**
 *
 * 验证参数
 *
 * @param $param
 * @param $verifi
 * @return bool
 * @author LuHao
 */
function valid($param, $verifi)
{
    $str = '';
    ksort($param);
    foreach ($param as $k => $v) {
        $str .= "$k=$v";
    }
    if (mb_strtoupper(md5($str)) == mb_strtoupper($verifi))
        return true;
    else
        return false;
}

/**
 *
 * 验证值(仅测试)
 *
 * @param $param
 * @return string
 * @author LuHao
 */
function verify($param)
{
    $str = '';
    ksort($param);
    foreach ($param as $k => $v) {
        $str .= "$k=$v";
    }
    return md5($str);
}
