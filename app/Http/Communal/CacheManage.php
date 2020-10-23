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
 * @method static CacheManage menu()
 */
class CacheManage
{
    /**
     * @var
     */
    private $method;
    /**
     * @var
     */
    private $param;

    /**
     * @var mixed
     */
    private $id;

    /**
     * CacheManage constructor.
     * @param $method
     */
    public function __construct($method, $param)
    {
        $this->method = $method;
        $this->param = $param;
        $this->id = current($param);
    }

    /**
     * @param $method
     * @param $param
     * @return CacheManage
     */
    public static function __callStatic($method, $param)
    {
        return new self($method, $param);
    }


    /**
     * @return string
     */
    public function getCacheKey()
    {
        return "Cache__" . $this->method . (empty($this->id) ? "" : ("__" . array_unshift($this->param)));
    }

    /**
     * @return mixed
     */
    public function getCacheData()
    {
        return Cache::get(self::getCacheKey());
    }

    /**
     * @param $data
     * @param int $ttl
     * @return mixed
     */
    public function setCacheData($data, $ttl = 0)
    {
        if ($ttl === 0) {
            Cache::forever(self::getCacheKey(), $data);
        } else {
            Cache::put(self::getCacheKey(), $data, $ttl);
        }
        return $data;
    }

    /**
     * @return bool
     */
    public function clearData()
    {
        return Cache::forget(self::getCacheKey());
    }
}
