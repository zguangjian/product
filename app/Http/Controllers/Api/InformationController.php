<?php

namespace App\Http\Controllers\Api;

use App\Http\Communal\RedisManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class InformationController extends Controller
{
    /**
     * 获取icons数据接口
     * @return JsonResponse
     * @throws \Exception
     */
    public function icons()
    {
        return responseJson('ok', 1, ['icons' => readJson('icons.json')]);
    }
}

