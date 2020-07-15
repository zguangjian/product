<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/7/6 17:10
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Services;


use App\Models\AdminModel;

class AdminService
{
    /**
     * 管理员是否登录
     * @return bool
     */
    public static function LoginStatus()
    {
        if (\Session::has('Admin')) {
            return true;
        }
        return false;
    }

    /**
     * 退出登录
     * @return int
     */
    public static function LoginOut()
    {
        return \Session::decrement('Admin');
    }

    /**
     * 获取登录用户信息
     * @return mixed
     */
    public static function LoginInfo()
    {
        return \Session::get('Admin');
    }

    /**
     * 更新管理员登录信息
     * @param $id
     * @param $data
     * @return int
     */
    public static function UpdateLoginInfo($admin, $data)
    {
        \Session::push('Admin', $admin);
        return AdminModel::where('id', $admin->id)->update($data);
    }


}
