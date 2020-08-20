<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformationController extends Controller
{
    /**
     * 获取icons数据接口
     * @return \Illuminate\Http\JsonResponse
     */
    public function icons()
    {
        return responseJson('ok', 1, ['icons' => fetchJson('icons.json')]);
    }
}
