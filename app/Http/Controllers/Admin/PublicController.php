<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\AdminService;
use App\Models\AdminModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Login(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, [
                'account' => 'required|min:4|max:32|exists:admin,account',
                'password' => 'required|min:6|max:16',
                'captcha' => 'required|captcha',
            ]);
            $admin = AdminModel::where('account', $request->get('account'))->first();

            if ($admin->status == 1) {
                return responseJson('该账号已禁用', 0);
            }

            if (!($password = hashCheck($request->get('password'), $admin->password))) {
                return responseJson('密码错误', 0);
            }

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
    public function LoginOut()
    {
        AdminService::LoginOut();
        return redirect()->route('admin-login');
    }
}
