<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/11/16 16:09
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Services;


use App\Http\Communal\CacheManage;
use App\Models\Permissions;

class AdminPermissionService
{
    /**
     * @return array|bool|mixed
     */
    public static function getPermission()
    {
        $permission = CacheManage::permission()->getCacheData();
        if ($permission == null) {
            $permission = Permissions::findAll()->toArray();
            $permission = array_column($permission, 'url', 'mid');
            return CacheManage::permission()->setCacheData($permission);
        }
        return $permission;
    }
}
