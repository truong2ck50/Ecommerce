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

    //Đăng kí, Đăng nhập
    Route::group(['namespace' => 'Auth'], function () {
        //Đăng nhập
        Route::get('login', 'LoginController@getLogin')->name('get.login');
        Route::post('login', 'LoginController@postLogin');

        //Đăng ký
        Route::get('register', 'RegisterController@getRegister')->name('get.register');
        Route::post('register', 'RegisterController@postRegister');

        //Đăng xuất
        Route::get('logout', 'LoginController@getLogOut')->name('get.logout');
    });

    //Trang chủ
    Route::get('', 'HomeController@index')->name('get.home');

    //Keyword
    Route::get('keyword/{slug}', 'KeywordController@index')->name('get.keyword');

    //Danh mục sản phẩm
    Route::get('danh-muc/{slug}', 'CategoryController@index')->name('get.category');

    //Chi tiết sản phẩm
    Route::get('san-pham/{slug}', 'ProductDetailController@index')->name('get.product_detail');

    //Menu bài viết
    Route::get('menu/{slug}', 'MenuController@index')->name('get.menu');
    Route::get('tag/{slug}', 'TagController@index')->name('get.tag');
    Route::get('bai-viet', 'ArticleController@index')->name('get.blog');

    //Chi tiết bài viết
    Route::get('bai-viet/{slug}', 'ArticleDetailController@index')->name('get.article_detail');

    //Giỏ hàng
    Route::get('cart.html', 'ShoppingCartController@index')->name('get.shopping');

    //Thanh toán
    Route::get('checkout.html', 'ShoppingCartController@checkout')->name('get.shopping.checkout');
    Route::post('checkout.html', 'ShoppingCartController@pay');

    //Sản phẩm ajax
    Route::group(['namespace' => 'Ajax', 'prefix' => 'ajax'], function () {
        Route::get('view-product/{id}', 'AjaxViewProductController@getPreviewProduct')->name('get_ajax.product_preview');
        Route::get('add/cart/{id}', 'AjaxShoppingCartController@add')->name('get_ajax.shopping.add');
        Route::get('delete/cart/{id}', 'AjaxShoppingCartController@delete')->name('get_ajax.shopping.delete');
        Route::get('update/cart/{id}', 'AjaxShoppingCartController@update')->name('get_ajax.shopping.update');
    });
});

include 'route_admin.php';
