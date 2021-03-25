<?php

use Illuminate\Support\Facades\Route;

//BACKEND
Route::group(['namespace' => 'User', 'prefix' => 'user'], function () {
    //Trang chủ
    Route::get('', 'UserController@index')->name('get_user.home');

});

