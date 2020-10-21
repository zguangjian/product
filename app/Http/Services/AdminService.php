<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/7/6 17:10
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Services;

use Session;

class AdminService
{
    /**
     * 管理员是否登录
     * @return bool
     */
    public static function LoginStatus()
    {
        if (Session::has('Admin')) {
            return true;
        }
        return false;
    }
}
