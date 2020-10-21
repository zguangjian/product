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
            return responseJson('ok', 0, Menu::all());
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
        if ($request->method() == 'POST') {
            $this->validate($request, [
                'name' => 'required|unique:menu',
                'parent_id' => 'required',
                'status' => 'required',
                'sort' => 'required',
            ]);

            if (Menu::create($request->post())) {
                return responseJson('操作成功', 1, ['url' => route('menu-index')]);
            }
            return responseJson('添加失败', 0);
        }

        return view('admin.menu.create');
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
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
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
                'name' => "required|unique:menu,name,$id",
                'parent_id' => 'required',
                'status' => 'required',
                'sort' => 'required',
            ]);
            if (Menu::find($id)->update($request->post())) {
                return responseJson('操作成功', 1, ['url' => route('menu-index')]);
            }
            return responseJson('操作失败', 0);
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
        return responseJson('删除成功');
    }
}
