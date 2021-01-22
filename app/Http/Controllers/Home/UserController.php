<?php

namespace App\Http\Controllers\Home;

use App\Http\Communal\RedisManage;
use App\Http\Controllers\Controller;
use App\Jobs\RedisEnd;
use App\Models\AdminModel;
use App\Models\MenuModel;
use Chumper\Zipper\Zipper;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{

    public function index(Zipper $zipper)
    {
//        $arr = ['index.php']; //需要打包目录或文件路径
//        $result = $zipper->make(public_path('test.zip'))->add($arr); // 添加需要打包路径，配置打包后路径以及文件名
//        $result->close();
        $orderId = "order:" . time();
        RedisEnd::dispatch($orderId)->delay(now()->addMinute(2))->onQueue('redisEnd');

//        $key = "example_key";
//        $payload = array(
//            "iss" => "http://example.org",
//            "aud" => "http://example.com",
//            "iat" => 1356999524,
//            "nbf" => 1357000000
//        );
//        $jwt = JWT::encode($payload, $key);
//        echo $jwt;
//        dd(JWT::decode($jwt, $key, array('HS256')));


        //$adminInfo = $admin->find(1)->toArray();

        //$response = $admin->addDoc($adminInfo);
        //$response = $admin->getDocs($adminInfo['id']);
        //$response = $admin->editDoc('ONI513YBldPNc-nqHvXV', $adminInfo);
        //$response = $admin->checkIndexExists();
        //dd($response);
    }

}
