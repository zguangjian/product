<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\AdminModel;
use App\Http\Services\AdminService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class PublicController extends Controller
{
    //
    public function Login(Request $request, Collection $collect)
    {
        if ($request->method() == 'POST') {
            $data = $request->post();
        }
        AdminModel::create([
            'account' => 'admin',
            'email' => 'zguangjian@outlook.com',
            'password' => hashMake('123456'),
            'loginIp' => '127.0.0.1',
            'status' => 1,
            'loginTime' => time(),
        ]);
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
