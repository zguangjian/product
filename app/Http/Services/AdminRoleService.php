<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/11/13 13:37
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Services;


use App\Http\Communal\CacheManage;
use App\Models\Role;

class AdminRoleService
{
    /**
     * @param $id
     * @return mixed
     */
    public static function getRoleRulePermission($id)
    {
        $permission = CacheManage::role_permission($id)->getCacheData();
        if ($permission == null) {
            $role = Role::findOne(['id' => $id]);
            return CacheManage::role_permission($id)->setCacheData(json_decode($role->rule, true));
        }
        return $permission;
    }
}
