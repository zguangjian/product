<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/7/6 16:29
 * Email: zguangjian@outlook.com
 */

/*自定义函数*/

/**
 * ajax数据返回
 * @param string $msg 信息
 * @param int $err 0失败 1成功
 * @param array $data 数据
 * @return \Illuminate\Http\JsonResponse
 */
function ResponseJson($msg = "", $err = 0, $data = [])
{
    header('Access-Control-Allow-Origin:*');
    $time = time();
    return response()->json(compact('err', 'msg', 'data', 'time'));
}


