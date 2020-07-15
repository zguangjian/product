<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/7/6 16:29
 * Email: zguangjian@outlook.com
 */

use Illuminate\Support\Facades\Hash;

/*自定义函数*/

/**
 * ajax数据返回
 * @param string $msg 信息
 * @param int $code 0失败 1成功
 * @param array $data 数据
 * @return \Illuminate\Http\JsonResponse
 */
function responseJson($msg = "", $code = 0, $data = [])
{
    header('Access-Control-Allow-Origin:*');
    $time = time();
    return response()->json(compact('code', 'msg', 'data', 'time'));
}

/**
 * 哈希加密字符串
 * @param $str
 * @return string
 */
function hashMake($str)
{
    return Hash::make($str);
}

/**
 * 验证哈希字符串是否匹配
 * @param $str
 * @param string $hashString
 * @return bool|string
 */
function hashCheck($str, $hashString = '')
{
    if (Hash::check($str, $hashString)) {
        //检查字符串是否需要被重新哈希
        if (Hash::needsRehash($hashString)) {
            $hashString = hashMake($str);
        }
        return $hashString;
    }
    return false;
}


