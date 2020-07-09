<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AdminModel;
use Faker\Generator as Faker;

$factory->define(AdminModel::class, function (Faker $faker) {
    return [
        'account' => $faker->name,
        'email' => $faker->email,
        'password' => hashMake('123456'),
        'loginIp' => '127.0.0.1',
        'status' => [0, 1][rand(0, 1)],
        'loginTime' => time()
    ];
});
