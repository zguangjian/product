<?php

namespace App\Http\Middleware\Admin;

use App\Http\Services\AdminPermissionService;
use App\Http\Services\AdminRoleService;
use App\Models\AdminRole;
use Closure;
use Exception;
use Illuminate\Http\Request;

class Auth
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
        if (!isSystem()) {
            $url = $request->route()->compiled->getStaticPrefix();
            //需要执行的url
            $permission = AdminPermissionService::getPermission();
            if (key_exists($url, array_flip($permission))) {
                //获取角色
                $role = AdminRole::findAll(['adminId' => admin()->id]);
                //获取角色权限
                $rolePermission = $urlList = [];
                /** @var AdminRole $value */
                foreach ($role as $value) {
                    $roleRule = AdminRoleService::getRoleRulePermission($value->roleId) ?: [];
                    $rolePermission = array_merge($rolePermission, array_values($roleRule));
                }

                foreach ($rolePermission as $key => $value) {
                    if (isset($permission[$value])) {
                        $urlList[$permission[$value]] = $key;
                    }
                }
                // TODO URLlIST
                if (!isset($urlList[$url])) {
                    if ($request->ajax()) {
                        return ajaxException("暂无权限", 500);
                    } else {
                        return view('error.rule')->with(['message' => 'No permissions!']);
                    }
                }
            }
        }

        return $next($request);
    }
}
