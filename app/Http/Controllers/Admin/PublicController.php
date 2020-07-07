<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\AdminService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class PublicController extends Controller
{
    //
    public function Login(Request $request, Collection $collect)
    {
        if ($request->method() == 'POST') {

        }
        return ResponseJson('1', '0', Route::getRoutes());
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
