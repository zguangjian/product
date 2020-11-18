<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\View\Factory as FactoryAlias;
use Illuminate\Http\JsonResponse as JsonResponseAlias;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * @param Router $route
     * @return FactoryAlias|View
     */
    public function index(Router $route)
    {
        return view('admin.index.index');
    }

    /**
     * @return FactoryAlias|View
     */
    public function welcome()
    {
        return view('admin.index.welcome');
    }

    /**
     * @return JsonResponseAlias
     */
    public function clear()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('clear-compiled');
        return responseJson();
    }

    /**
     * @param Request $request
     * @return FactoryAlias|JsonResponseAlias|View
     */
    public function password(Request $request)
    {
        if ($request->post()) {
            Admin::findOne(['id' => admin()->id])->update(['password' => hashMake($request->post('password'))]);
            return responseJson([], 0, '操作成功');
        }
        return view('admin.index.password');
    }


}
