<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/8/18 15:10
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Services;


use App\Models\MenuModel;

class AdminMenuService
{
    public static function getMenuList()
    {
        $list = MenuModel::all();
    }
}
