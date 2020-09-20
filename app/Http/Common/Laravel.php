<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/9/20 23:09
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Common;


class Laravel
{
    public static $app;

    /**
     * @return mixed
     */
    public static function getApp()
    {
        return self::$app;
    }

    public function __construct($app)
    {
        dd(1);
    }

    public static function __callStatic($name, $arguments)
    {
        echo "Static Calling " . $name . " whith parameters:" . implode(", ", $arguments);
    }

}
