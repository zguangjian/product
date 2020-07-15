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
    Route::get('/', 'IndexController@Index')->name('admin-index');
    Route::get('welcome', 'IndexController@Welcome')->name('admin-welcome');

    Route::group(['prefix' => 'menu'], function () {
        Route::get('index', 'MenuIndexController@Index')->name('menu-index');
        Route::match(['get', 'post'], 'add', 'MenuIndexController@Add')->name('menu-add');
        Route::match(['get', 'post'], 'edit/{id}', 'MenuIndexController@Edit')->name('menu-edit');
        Route::get('del/{id}', 'MenuIndexController@Del')->name('menu-del');
    });

});
