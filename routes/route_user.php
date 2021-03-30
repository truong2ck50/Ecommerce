<?php

use Illuminate\Support\Facades\Route;

//BACKEND
Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => 'checkLoginUser'], function () {
    //Trang chủ
    Route::get('', 'UserController@index')->name('get_user.home');

    //Profile
    Route::get('profile/{id}', 'UserProfileController@index')->name('get_user.profile');
    Route::post('profile/{id}', 'UserProfileController@update');

    //Transaction
    Route::prefix('transaction')->group(function() {
        Route::get('', 'UserTransactionController@index')->name('get_user.transaction.index');
        Route::get('view/{id}', 'UserTransactionController@view')->name('get_user.transaction.view');
        Route::get('success/{id}', 'UserTransactionController@success')->name('get_user.transaction.success');
        Route::get('cancel/{id}', 'UserTransactionController@cancel')->name('get_user.transaction.cancel');
        Route::get('delete/{id}', 'UserTransactionController@delete')->name('get_user.transaction.delete');
    });

    //Order
    Route::prefix('order')->group(function() {
        Route::get('delete/{id}', 'UserOrderController@delete')->name('get_user.order.delete');
    });

    //Vote
    Route::prefix('vote')->group(function() {
        Route::get('create/{productID}', 'UserVoteController@create')->name('get_user.vote.create');
        Route::post('create/{productID}', 'UserVoteController@store');
        
    });

});

