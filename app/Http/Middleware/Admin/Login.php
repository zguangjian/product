<?php

namespace App\Http\Middleware\Admin;

use App\Http\Services\AdminService;
use Closure;
use Exception;
use Illuminate\Http\Request;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        if (!AdminService::LoginStatus()) {
            if ($request->ajax()) {
                return ajaxException("请重新登录", 502);
            } else {
                return redirect()->route('admin-login');
            }
        }
        return $next($request);
    }
}
