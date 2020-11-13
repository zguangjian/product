<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2020/7/6 16:00
 * Email: zguangjian@outlook.com
 */
/** 公共目录 */
Route::group(['prefix' => 'public'], function () {
    Route::match(['get', 'post'], 'login', 'PublicController@login')->name('admin-login');
    Route::get('out', 'PublicController@loginOut')->name('admin-login-out');
});
Route::group(['middleware' => ['admin.Login', 'admin.Auth']], function () {
    Route::get('/', 'IndexController@index')->name('admin-index');
    Route::get('welcome', 'IndexController@welcome')->name('admin-welcome');
    Route::get('clear', 'IndexController@clear')->name('admin-clear');
    /** 菜单*/
    Route::group(['prefix' => 'menu'], function () {
        Route::get('index', 'MenuController@index')->name('menu-index');
        Route::match(['get', 'post'], 'create', 'MenuController@create')->name('menu-create');
        Route::match(['get', 'post'], 'update/{id?}', 'MenuController@update')->name('menu-update');
        Route::get('destroy', 'MenuController@destroy')->name('menu-destroy');
    });
    /** 管理员*/
    Route::group(['prefix' => 'manager'], function () {
        Route::get('index', 'ManageController@index')->name('manager-index');
        Route::match(['get', 'post'], 'create', 'ManageController@create')->name('manager-create');
        Route::match(['get', 'post'], 'update/{id}', 'ManageController@update')->name('manager-update');
        Route::get('destroy', 'ManageController@destroy')->name('manager-destroy');
    });
    /** 网站配置*/
    Route::group(['prefix' => 'setting'], function () {
        Route::get("index", 'SettingController@index')->name("setting-index");
        Route::match(['get', 'post'], 'create', 'SettingController@create')->name('setting-create');
        Route::match(['get', 'post'], 'update/{id}', 'SettingController@update')->name('setting-update');
        Route::get('destroy', 'SettingController@destroy')->name('setting-destroy');
    });
    /** 管理员 */
    Route::group(['prefix' => 'admin'], function () {
        Route::get('index', 'AdminController@index')->name('admin-list');
        Route::match(['get', 'post'], 'create', 'AdminController@create')->name('admin-create');
        Route::match(['get', 'post'], 'update/{id}', 'AdminController@update')->name('admin-update');
        Route::post('edit', 'AdminController@edit')->name('admin-edit');
        Route::get('destroy', 'AdminController@destroy')->name('admin-destroy');
    });
    /** 角色管理 */
    Route::group(['prefix' => "role"], function () {
        Route::get("index", "RoleController@index")->name("role-index");
        Route::match(['get', 'post'], 'create', "RoleController@create")->name("role-create");
        Route::match(['get', 'post'], 'update', "RoleController@update")->name("role-update");
        Route::post('edit', "RoleController@edit")->name("role-edit");
        Route::match(['get', 'post'], 'rule/{id?}', "RoleController@rule")->name("role-rule");
        Route::get('destroy', 'RoleController@destroy')->name("role-destroy");
    });
    /** 日志 */
    Route::group(['prefix' => "log"], function () {
        Route::get("index", "LogController@index")->name("log-index");
    });


});
