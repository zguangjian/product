<?php
namespace App\Http\Controllers\Admin\Shop;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //如果是ajax请求 返回json 否贼视图  视图里用table插件动态去ajax去拉数据
        if($request->ajax())
        {
            $paginate = Product::paginate($request->get('limit'));
            //这里直接返回json数据了 终止
        return responseJson($paginate->items(),'0','ok',['count' => $paginate->total()]);
        }


         return view('admin.shop.product.index');
    }

    public function create(Request $request)
    {
        if($request->ajax()){
            if(Product::create($request->post())){
                return responseJson([],0,'添加成功');
            }else{
                return responseJson([],1,'添加失败');
            }

        }
        return view('admin.shop.product.create');
    }

    public function update(Request $request,$id)
    {
        $product = Product::findOne(['id'=>$id]);
        //是post提交 就那数据去修改 否则渲染视图
        if ($request->post()){
            $product->update($request->post());
            if($product->save()){
                return responseJson([],0,'修改成功');
            }else{
                return responseJson([],1,'修改失败');
            }
        }
        return view('admin.shop.product.update',['product'=>$product]);
    }

    public function edit()
    {

    }
}