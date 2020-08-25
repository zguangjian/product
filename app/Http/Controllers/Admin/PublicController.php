<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\AdminService;
use App\Models\Admin;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, [
                'account' => 'required|min:4|max:32|exists:admin,account',
                'password' => 'required|min:6|max:16',
                'captcha' => 'required|captcha',
            ]);
            $admin = Admin::where('account', $request->get('account'))->first();

            if ($admin->status == 0) {
                return responseJson('该账号已禁用', 0);
            }

            if (($password = hashCheck($request->get('password'), $admin->password)) === false) {
                return responseJson('密码错误', 0);
            }
            /*更新信息*/
            AdminService::UpdateLoginInfo($admin, [
                'password' => $password,
                'loginTime' => time(),
                'loginIp' => request()->ip(),
            ]);
            return responseJson('登录成功！', 1, ['url' => url()->route('admin-index')]);
        }
        return view('admin.public.login');
    }


    /**
     * 退出登录
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginOut()
    {
        AdminService::LoginOut();
        return redirect()->route('admin-login');
    }
}
