<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/8/18 15:10
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Services;


use App\Http\Communal\CacheManage;
use App\Models\MenuModel;

class AdminMenuService
{
    /**
     * @return bool
     */
    public static function menuCacheClear()
    {
        return CacheManage::menu()->clearData() && AdminPermissionService::permissionCacheClear();
    }
}
