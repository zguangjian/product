<?php

namespace App\Http\Middleware\Admin;

use App\Http\Services\AdminService;
use Closure;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!AdminService::LoginStatus()) {
            return redirect()->route('admin-login');
        }
        return $next($request);
    }
}
