<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\AdminService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Router;

class IndexController extends Controller
{
    //
    public function index(Router $route)
    {
        return view('admin.index.index');
    }

    public function welcome()
    {
        return view('admin.index.welcome');
    }

}
