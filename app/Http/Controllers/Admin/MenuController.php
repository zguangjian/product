<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|JsonResponse|Response|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return responseJson(menuList(), 0);
        }
        return view('admin.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Factory|JsonResponse|Response|View
     * @throws ValidationException
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'name' => 'required|unique:menu',
                'parent_id' => 'required',
                'status' => 'required',
                'sort' => 'required',
            ]);

            if (Menu::create($request->post())) {
                return responseJson(['url' => route('menu-index')], 0, '操作成功');
            }
            return responseJson([], 1, '添加失败');
        }
        return view('admin.menu.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Factory|JsonResponse|View
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        if ($request->ajax()) {
            $this->validate($request, [
                'name' => "required|unique:menu,name,$id,id",
                'parent_id' => 'required',
                'status' => 'required',
                'sort' => 'required',
            ]);
            if ($menu->update($request->post())) {
                return responseJson(['url' => route('menu-index')], 0, '操作成功');
            }
            return responseJson([], 1, '操作失败');
        }
        return view('admin.menu.update')->with(compact('menu'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse|Response
     * @throws ValidationException
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        Menu::destroy($request->get('id'));
        return responseJson([], 0, '删除成功');
    }
}
