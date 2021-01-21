<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/11/16 16:09
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Services;


use App\Http\Communal\CacheManage;
use App\Models\PermissionsModel;

class AdminPermissionService
{
    /**
     * @return array|bool|mixed
     */
    public static function getPermission()
    {
        $permission = CacheManage::permission()->getCacheData();
        if ($permission == null) {
            $permission = PermissionsModel::findAll()->toArray();
            $permission = array_column($permission, 'url', 'mid');
            return CacheManage::permission()->setCacheData($permission);
        }
        return $permission;
    }

    /**
     * @return bool
     */
    public static function permissionCacheClear()
    {
        return CacheManage::permission()->clearData();
    }
}
