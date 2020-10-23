<?php

namespace App\Http\Controllers\Admin;

use App\Http\Communal\RedisManage;
use App\Http\Services\AdminService;
use App\Models\Admin;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Redis\RedisManager;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Session;

class PublicController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|JsonResponse|View
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, [
                'account' => 'required|min:4|max:32|exists:admin,account',
                'password' => 'required|min:6|max:16',
                'captcha' => 'required|captcha',
            ]);
            $admin = Admin::where(['account' => $request->get('account')])->first();

            if ($admin->status == 0) {
                return responseJson([], 0, '该账号已禁用');
            }

            if (($password = hashCheck($request->get('password'), $admin->password)) === false) {
                return responseJson([], 0, '密码错误');
            }
            /*更新信息*/
            $admin->update([
                'password' => $password,
                'loginTime' => time(),
                'loginIp' => request()->ip(),
            ]);
            Session::put('Admin', $admin);
            return responseJson(['url' => url()->route('admin-index')], 1, '登录成功！');
        }
        return view('admin.public.login');
    }


    /**
     * @return RedirectResponse
     */
    protected function loginOut()
    {
        AdminService::LoginOut();
        return redirect()->route('admin-login');
    }
}
