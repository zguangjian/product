<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\AdminRoleService;
use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Throwable;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|JsonResponse|View|void
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $paginate = Role::paginate($request->get('limit'));
            return responseJson($paginate->items(), 0, 'ok', ['count' => $paginate->total()]);
        }
        return view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return JsonResponse|void
     * @throws Throwable
     */
    public function edit(Request $request)
    {

        DB::transaction(function () use ($request) {
            Admin::whereId($request->get('id'))->update($request->all());
        });
        return responseJson([], 0, '修改成功');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Update the Role's Rule
     *
     * @param $id
     * @param Request $request
     * @return Factory|JsonResponse|View
     */
    public function rule($id, Request $request)
    {
        $role = Role::find($id);
        if ($request->ajax()) {
            $rule = $request->post('rule', []);
            $role->rule = json_encode($rule);
            $role->save();
            return responseJson([], 0, '操作成功');
        }
        $roleRule = $role->rule === null ? [] : json_decode($role->rule, true);
        return view('admin.role.rule', compact('role', 'rule', 'roleRule'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return void
     */
    public function destroy()
    {
        //
    }
}
