<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/7/6 16:00
 * Email: zguangjian@outlook.com
 */

Route::group(['prefix' => 'public'], function () {
    Route::match(['get', 'post'], 'login', 'PublicController@login')->name('admin-login');
    Route::get('out', 'PublicController@loginOut')->name('admin-login-out');
});
Route::group(['middleware' => ['admin.Login', 'admin.Auth']], function () {
    Route::get('/', 'IndexController@index')->name('admin-index');
    Route::get('welcome', 'IndexController@welcome')->name('admin-welcome');
    /*菜单*/
    Route::group(['prefix' => 'menu'], function () {
        Route::get('index', 'MenuController@index')->name('menu-index');
        Route::match(['get', 'post'], 'create', 'MenuController@create')->name('menu-create');
        Route::match(['get', 'post'], 'update/{id}', 'MenuController@update')->name('menu-update');
        Route::get('destroy/{id}', 'MenuController@destroy')->name('menu-destroy');
    });
    /*管理员*/
    Route::group(['prefix' => 'manager'], function () {

    });
    /*网站配置*/
    Route::group(['prefix' => 'setting'], function () {

    });

});
