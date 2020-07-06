<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\AdminService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    //
    public function Login(Request $request)
    {
        if ($request->method() == 'POST') {

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
