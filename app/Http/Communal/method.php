<?php


/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/7/6 16:29
 * Email: zguangjian@outlook.com
 */

use App\Models\AdminModel;
use App\Models\AdminRoleModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\MenuModel;
use App\Http\Communal\CacheManage;

/**
 * ajax数据返回
 * @param array $data 数据
 * @param int $code 0成功 1失败
 * @param string $msg 信息
 * @param array $other
 * @return JsonResponse
 */
function responseJson($data = [], $code = 0, $msg = "ok", $other = [])
{
    header('Access-Control-Allow-Origin:*');
    $data = [
        "code" => $code,
        "msg" => $msg,
        "data" => $data,
        "time" => time()
    ];
    foreach ($other as $key => $value) {
        $data[$key] = $value;
    }
    return response()->json($data);
}

/**
 * @param $msg
 * @param $code 504重定向
 * @return JsonResponse
 * @throws Exception
 */
function ajaxException($msg = "", $code = 500)
{
    return response()->json(['message' => $msg], $code);
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
 * @return null|AdminModel
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
    $list = [];
    /** @var \Illuminate\Routing\Route $route */
    foreach (app('router')->getRoutes() as $route) {
        /*筛选后台路由*/
        if (in_array('admin.Login', $route->gatherMiddleware()) && $route->getPrefix() != "admin") {
            /*过滤参数 {param}*/
            $explodeList = explode('/', $route->uri);
            foreach ($explodeList as $key => $value) {
                if (substr($value, 0, 1) == '{' && substr($value, -1) == '}') {
                    unset($explodeList[$key]);
                }
            }
            $list[] = [
                'name' => $route->getName(),
                'uri' => implode('/', $explodeList),
                'requestUrl' => '/' . implode('/', $explodeList)
            ];
        }
    }
    return $list;
}

/**
 * 随机ip
 * @return string
 */
function roundIp()
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

/**
 * 读取文件json文件夹json文件
 * @param $file
 * @return mixed
 * @throws Exception
 */
function readJson($file)
{
    if (file_exists($file)) {
        ajaxException("文件不存在");
    }
    return json_decode(file_get_contents("./json/$file"), true);
}

/**
 * 获取所有子类
 * @param array $arr
 * @param $myId
 * @return array|bool
 */
function getChild($arr, $myId)
{
    $newArr = [];
    if (is_array($arr)) {
        foreach ($arr as $id => $a) {
            if ($a['parent_id'] == $myId) {
                $newArr[$id] = $a;
            }
        }
    }
    if (gettype($arr) == 'object') {
        foreach ($arr as $id => $a) {
            if ($a->parent_id == $myId) {
                $newArr[$id] = $a;
            }
        }
    }
    return $newArr ? $newArr : false;
}

/**
 * 生成树型结构数组
 * @param $list
 * @param $myId
 * @param int $maxLevel 最大获取层级,默认不限制
 * @param int $level 当前层级,只在递归调用时使用,真实使用时不传入此参数
 * @param string $filed
 * @return array
 */
function getTreeArray($list, $myId, $maxLevel = 0, $level = 1, $filed = "children")
{
    $returnArray = [];
    //一级数组
    $children = getChild($list, $myId);
    if (is_array($children)) {
        foreach ($children as $child) {
            $child['_level'] = $level;
            $returnArray[$child['id']] = $child;
            if ($maxLevel === 0 || ($maxLevel !== 0 && $maxLevel > $level)) {
                $mLevel = $level + 1;
                $returnArray[$child['id']][$filed] = getTreeArray($list, $child['id'], $maxLevel, $mLevel, $filed);
            }
        }
    }
    return $returnArray;
}

/**
 * 菜单
 * @param string $filed
 * @param bool $isLeft
 * @return mixed
 */
function menu($isLeft = false, $filed = "children")
{
    $menuList = menuList();
    if ($isLeft == true) {
        foreach ($menuList as $key => $value) {
            if ($value['status'] == 0) {
                unset($menuList[$key]);
            }
        }
    }
    return getTreeArray($menuList, 0, 4, 1, $filed);
}

/**
 * 菜单列表
 * @return mixed
 */
function menuList()
{
    if ($menuList = CacheManage::menu()->getCacheData()) {
        return $menuList;
    }
    $menuList = MenuModel::orderBy("sort", "asc")->orderBy("id", "asc")->get()->toArray();
    return CacheManage::menu()->setCacheData($menuList, 0);
}

/**
 * 是否有权限
 * @param $id
 * @param array $ruleList
 * @param $system
 * @return string
 */
function rule($id, array $ruleList, $system)
{
    if (in_array($id, $ruleList) || $system == 1) {
        return "checked = ''";
    }
    return "";
}

/**
 * @return bool
 */
function isSystem()
{
    return admin()->id == 1 || AdminRoleModel::findOne(['adminId' => admin()->id, 'roleId' => 1]) != null ? true : false;
}


