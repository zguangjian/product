<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/10/20 14:49
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Communal;


use Illuminate\Support\Facades\Redis;

/**
 * Class RedisManage
 * @package App\Http\Communal
 * @method static RedisManage menu()
 */
class RedisManage
{
    /**
     * @var
     */
    private $method;

    /**
     * @var
     */
    private $key;

    /**
     * CacheManage constructor.
     * @param $method
     * @param $key
     */


    public function __construct($method, $key)
    {
        $this->method = $method;
        $this->key = $key;
    }

    /**
     * @param $method
     * @param $param
     * @return RedisManage
     */
    public static function __callStatic($method, $param)
    {
        return new self(ucfirst($method), reset($param));
    }

    /**
     * @param string $mold
     * @return string
     */
    public function getCacheKey($mold = "cache")
    {
        return "Redis__" . ucfirst($mold) . "__" . $this->method . ($this->key === false ? "" : ("__" . $this->key));
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getCacheData()
    {
        return Redis::get(self::getCacheKey());
    }

    /**
     * @param $data
     * @param callable $callback
     * @return mixed
     */
    public function setCacheData($data, callable $callback)
    {
        Redis::set(self::getCacheKey(), $data);
        return call_user_func($callback);

    }

    /**
     * @return bool
     */
    public function clearCacheData()
    {
        return Redis::del(self::getCacheKey());
    }


    /**
     * @param int $start
     * @param int $len
     * @return mixed
     */
    public function getListData($start = 0, $len = 1)
    {
        return Redis::lrange(self::getCacheKey("list"), $start, $len);
    }

    /**
     * @param $data
     * @param string $direction
     * @return mixed
     */
    public function setListData($data, $direction = "l")
    {
        if ($direction == "l") {
            return Redis::lpush(self::getCacheKey("list"), $data);
        }
        return Redis::rpush(self::getCacheKey("list"), $data);
    }


    /**
     * @return mixed
     */
    public function getHashData($key)
    {
        return Redis::hget(self::getCacheKey("hash"), $key);
    }

    /**
     * @return mixed
     */
    public function getHashAllData()
    {
        return Redis::hgetall(self::getCacheKey("hash"));
    }

    /**
     * @param $key
     * @param $data
     * @return mixed
     */
    public function setHashData($key, $data)
    {
        return Redis::hset(self::getCacheKey("hash"), $key, $data);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function clearHashData($key)
    {
        return Redis::del(self::getCacheKey("hash"), $key);
    }
}
