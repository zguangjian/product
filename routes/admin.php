<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/7/6 16:00
 * Email: zguangjian@outlook.com
 */

Route::group(['prefix' => 'public'], function () {
    Route::match(['get', 'post'], 'login', 'PublicController@Login')->name('admin-login');
    Route::get('out', 'PublicController@out');
});
Route::group(['middleware' => ['admin.Login', 'admin.Auth']], function () {
    Route::get('/', 'IndexController@Index');

});
