<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//FRONTEND
Route::group(['namespace' => 'Frontend'], function () {
    //Trang chủ
    Route::get('', 'HomeController@index')->name('get.home');

    //Danh mục sản phẩm
    Route::get('danh-muc/{slug}', 'CategoryController@index')->name('get.category');

    //Chi tiết sản phẩm
    Route::get('san-pham/{slug}', 'ProductDetailController@index')->name('get.product_detail');

    //Menu bài viết
    Route::get('menu/{slug}', 'MenuController@index')->name('get.menu');

    //Chi tiết bài viết
    Route::get('bai-viet/{slug}', 'ArticleDetailController@index')->name('get.article_detail');
});

include 'route_admin.php';
