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

/**
 * 管理员信息
 * @return mixed
 */
function admin()
{
    return Session::get('Admin');
}

/**
 * 获取后台路由
 * @return array
 */
function adminMenu()
{
    foreach (app('router')->getRoutes() as $route) {
        /*筛选后台路由*/
        if (in_array('admin.Login', $route->gatherMiddleware())) {
            /*过滤参数 {param}*/
            $explodeList = explode('/', $route->uri);
            foreach ($explodeList as $key => $value) {
                if (substr($value, 0, 1) == '{' && substr($value, -1) == '}') {
                    unset($explodeList[$key]);
                }
            }
            $list[] = implode('/', $explodeList);
        }
    }
    return $list;
}

function ip()
{
    $ip_long = array(
        array('607649792', '608174079'), // 36.56.0.0-36.63.255.255
        array('1038614528', '1039007743'), // 61.232.0.0-61.237.255.255
        array('1783627776', '1784676351'), // 106.80.0.0-106.95.255.255
        array('2035023872', '2035154943'), // 121.76.0.0-121.77.255.255
        array('2078801920', '2079064063'), // 123.232.0.0-123.235.255.255
        array('-1950089216', '-1948778497'), // 139.196.0.0-139.215.255.255
        array('-1425539072', '-1425014785'), // 171.8.0.0-171.15.255.255
        array('-1236271104', '-1235419137'), // 182.80.0.0-182.92.255.255
        array('-770113536', '-768606209'), // 210.25.0.0-210.47.255.255
        array('-569376768', '-564133889'), // 222.16.0.0-222.95.255.255
    );
    $rand_key = mt_rand(0, 9);
    return $ip = long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
}




