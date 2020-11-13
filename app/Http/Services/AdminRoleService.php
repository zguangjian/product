<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/11/13 13:37
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Services;


class AdminRoleService
{
    public static function permissions($rule = [])
    {
        dd(permission());
    }


    public static function permissionAttr($item)
    {

    }
}
