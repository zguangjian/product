<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/9/20 23:32
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Common;

use Cache;


/**
 * Class LaraveCache
 * @method static Menu  Menu()
 * @method static AdminRole  AdminRole()
 * @package App\Http\Common
 */
class LaravelCache
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param $app
     * @param $arguments
     * @return LaravelCache
     */
    public static function __callStatic($app, $arguments)
    {
        return new self($app);
    }

    /**
     * @return string
     */
    public function getCacheKey()
    {
        return "Laravel__" . $this->app . "__" . admin()->id;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return Cache::get($this->getCacheKey());
    }

    /**
     * @param $data
     * @return bool
     */
    public function setData($data)
    {
        return Cache::forever($this->getCacheKey(), $data);
    }

    /**
     * @param $data
     * @param $duration
     * @return bool
     */
    public function setDataMinute($data, $duration)
    {
        return Cache::put($this->getCacheKey(), $data, $duration);
    }

    /**
     * @return bool
     */
    public function clearData()
    {
        return Cache::clear($this->getCacheKey());
    }
}
