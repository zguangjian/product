<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\AdminService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function Index()
    {
        return view('admin.index.index');
    }

    public function Welcome()
    {
        return view('admin.index.welcome');
    }

}
