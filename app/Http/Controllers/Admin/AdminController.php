<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\AdminModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class AdminController extends Controller
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
            $paginate = AdminModel::paginate($request->get('limit'));
            return responseJson($paginate->items(), 0, 'ok', ['count' => $paginate->total()]);
        }

        return view("admin.admin.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        dd(roundIp());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
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
     *  editing the specified resource.
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function edit(Request $request)
    {
        $param = $request->post();
        if (isset($param['password'])) {
            $param['password'] = hashMake($param['password']);
        }
        AdminModel::findOne($request->post('id'))->update($param);
        return responseJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Factory|JsonResponse|View|void
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $admin = AdminModel::find($id);
        if ($request->ajax()) {
            $this->validate($request, [

            ]);
            $admin->update($request->post());
            $admin->save();
            return responseJson();
        }
        return view('admin.admin.update', compact('admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse|void
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        if ($id == 1 || (gettype($id) == 'array' && in_array(1, $id))) {
            return ajaxException('无法删除超级管理员');
        }

        try {
            DB::transaction(function () use ($id) {
                AdminModel::destroy($id);
            });
        } catch (Throwable $e) {
            return responseJson([], 1, $e->getMessage());
        }
        return responseJson();
    }
}
