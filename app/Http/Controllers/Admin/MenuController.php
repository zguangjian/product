<?php

namespace App\Http\Controllers\Admin;

use App\Http\Communal\CacheManage;
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
     * @return Factory|JsonResponse|Response|View
     */
    public function index()
    {
        return view('admin.menu.index');
    }

    /**
     * @return JsonResponse
     */
    public function ajax()
    {
        return responseJson(menuList());
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
        if ($request->method() == 'POST') {
            $this->validate($request, [
                'name' => 'required|unique:menu',
                'parent_id' => 'required',
                'status' => 'required',
                'sort' => 'required',
            ]);

            if (Menu::create($request->post())) {
                return responseJson(['url' => route('menu-index')], 1, '操作成功');
            }
            return responseJson([], 0, '添加失败');
        }

        return view('admin.menu.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Factory|JsonResponse|View
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        if ($request->method() == 'POST') {
            $this->validate($request, [
                'name' => "required|unique:menu,name,$id,id",
                'parent_id' => 'required',
                'status' => 'required',
                'sort' => 'required',
            ]);
            if ($menu->update($request->post())) {
                return responseJson(['url' => route('menu-index')], 1, '操作成功');
            }
            return responseJson([], 0, '操作失败');
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
        $idList = [];
        //获取子类菜单
        if (gettype($request->get('id')) == 'string') {
            array_push($idList, $request->get('id'));
            $menuList = Menu::parentMenu($request->get('id'));
            foreach ($menuList as $value) {
                array_push($idList, $value['id']);
                if (count($value['children']) > 0) {
                    foreach ($value['children'] as $child) {
                        array_push($idList, $child['id']);
                    }
                }
            }
        } else {
            $idList = array_merge($idList, $request->get('id'));
        }
        //删除
        Menu::destroy($idList);
        return responseJson([], 1, '删除成功');
    }
}
