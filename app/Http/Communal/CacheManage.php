<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/9/27 17:07
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Communal;

use Illuminate\Support\Facades\Cache;

/**
 * Class CacheManage
 * @package App\Http\Communal
 * @method static CacheManage user()
 */
class CacheManage
{
    private $method;

    /**
     * CacheManage constructor.
     * @param $method
     */
    public function __construct($method)
    {
        $this->method = $method;
    }

    /**
     * @param $method
     * @param $param
     * @return CacheManage
     */
    public static function __callStatic($method, $param)
    {
        return new self($method);
    }


    /**
     * @param $key
     * @return string
     */
    public function getCacheKey($key)
    {
        return "Cache__" . $this->method . "__" . $key;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getCacheData($key)
    {
        return Cache::get(self::getCacheKey($key));
    }

    /**
     * @param $key
     *
     * @param $data
     * @param $ttl
     * @return mixed
     */
    public function setCacheData($key, $data, $ttl = 0)
    {
        if ($ttl === 0) {
            return Cache::forever(self::getCacheKey($key), $data);
        }
        return Cache::put(self::getCacheKey($key), $data, $ttl);
    }

    /**
     * @param $key
     * @return bool
     */
    public function clearData($key)
    {
        return Cache::forget(self::getCacheKey($key));
    }
}
