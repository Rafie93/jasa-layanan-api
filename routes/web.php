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

Route::get('unauthorised','Api\LoginController@unauthorised')->name('unauthorised');
Route::get('/login','Auth\LoginController@index')->name('login');
Route::post('/postlogin','Auth\LoginController@postlogin')->name('login.post');
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::get('/','Auth\LoginController@index')->name('logon');

Route::get('/test', function () {
    return view('master.o.test');
});
Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard','Dashboard\DashboardController@index')->name('dashboard');

    //Category Product
    Route::get('products/category', ['as' => 'products.category', 'uses' => 'Product\CategoryController@index']);
    Route::get('products/data', ['as' => 'products.index', 'uses' => 'Product\ProductController@index']);
    Route::get('products/add', ['as' => 'products.add', 'uses' => 'Product\ProductController@add']);
    Route::get('products/data/{id}/detail', ['as' => 'products.detail', 'uses' => 'Product\ProductController@detail']);
    Route::get('products/{id}/edit', ['as' => 'products.edit', 'uses' => 'Product\ProductController@edit']);
    Route::post('products/{id}/update', ['as' => 'products.update', 'uses' => 'Product\ProductController@update']);
    Route::post('products/{id}/store', ['as' => 'products.store', 'uses' => 'Product\ProductController@store']);

    /**
     * Bank Account Routes
     */
    Route::get('master/bank', ['as' => 'bank.index', 'uses' => 'Master\BankController@index']);
    Route::get('master/bank/add', ['as' => 'bank.add', 'uses' => 'Master\BankController@add']);
    Route::post('master/bank/store', ['as' => 'bank.store', 'uses' => 'Master\BankController@store']);
    Route::get('master/bank/{id}/edit', ['as' => 'bank.edit', 'uses' => 'Master\BankController@edit']);
    Route::post('master/bank/{id}/update', ['as' => 'bank.update', 'uses' => 'Master\BankController@update']);
    Route::get('master/bank/{id}/delete', ['as' => 'bank.delete', 'uses' => 'Master\BankController@delete']);

    /**
     * Point Routes
     */
    Route::get('master/point', ['as' => 'point.index', 'uses' => 'Master\SistemPointController@index']);
    Route::get('master/point/add', ['as' => 'point.add', 'uses' => 'Master\SistemPointController@add']);
    Route::post('master/point/store', ['as' => 'point.store', 'uses' => 'Master\SistemPointController@store']);
    Route::get('master/point/{id}/edit', ['as' => 'point.edit', 'uses' => 'Master\SistemPointController@edit']);
    Route::post('master/point/{id}/update', ['as' => 'point.update', 'uses' => 'Master\SistemPointController@update']);
    Route::get('master/point/{id}/delete', ['as' => 'point.delete', 'uses' => 'Master\SistemPointController@delete']);

     /**
     * Customer Routes
     */
    Route::get('customer/data', ['as' => 'customer.index', 'uses' => 'Customer\CustomerController@index']);
    Route::get('customer/add', ['as' => 'customer.add', 'uses' => 'Customer\CustomerController@add']);
    Route::post('customer/store', ['as' => 'customer.store', 'uses' => 'Customer\CustomerController@store']);
    Route::get('customer/{id}/edit', ['as' => 'customer.edit', 'uses' => 'Customer\CustomerController@edit']);
    Route::post('customer/{id}/update', ['as' => 'customer.update', 'uses' => 'Customer\CustomerController@update']);
    Route::get('customer/{id}/detail', ['as' => 'customer.detail', 'uses' => 'Customer\CustomerController@detail']);
    Route::get('customer/{id}/delete', ['as' => 'customer.delete', 'uses' => 'Customer\CustomerController@delete']);

    /**
     * Vendor Routes
     */

    Route::get('vendor/data', ['as' => 'vendor.index', 'uses' => 'Vendor\VendorController@index']);
    Route::get('vendor/add', ['as' => 'vendor.add', 'uses' => 'Vendor\VendorController@add']);
    Route::post('vendor/store', ['as' => 'vendor.store', 'uses' => 'Vendor\VendorController@store']);
    Route::get('vendor/{id}/edit', ['as' => 'vendor.edit', 'uses' => 'Vendor\VendorController@edit']);
    Route::post('vendor/{id}/update', ['as' => 'vendor.update', 'uses' => 'Vendor\VendorController@update']);
    Route::get('vendor/{id}/delete', ['as' => 'vendor.delete', 'uses' => 'Vendor\VendorController@delete']);

    /**
     * Order Routes
     */

    Route::get('order/order', ['as' => 'order.order', 'uses' => 'Order\OrderController@request']);
    Route::get('order/{id}/detail', ['as' => 'order.detail', 'uses' => 'Order\OrderController@detail']);
    Route::post('order/{id}/update', ['as' => 'order.update', 'uses' => 'Order\OrderController@update']);

    // Inbox Route
    Route::get('inbox/index', ['as' => 'inbox.index', 'uses' => 'Inbox\InboxController@index']);


    /**
     * banner Routes
     */

    Route::get('landing/banner/data', ['as' => 'banner.index', 'uses' => 'Landings\BannerController@index']);
    Route::get('landing/banner/add', ['as' => 'banner.add', 'uses' => 'Landings\BannerController@add']);
    Route::post('landing/banner/store', ['as' => 'banner.store', 'uses' => 'Landings\BannerController@store']);
    Route::get('landing/banner/{id}/edit', ['as' => 'banner.edit', 'uses' => 'Landings\BannerController@edit']);
    Route::post('landing/banner/{id}/update', ['as' => 'banner.update', 'uses' => 'Landings\BannerController@update']);
    Route::get('landing/banner/{id}/delete', ['as' => 'banner.delete', 'uses' => 'Landings\BannerController@delete']);


    /**
     * News Routes
     */

    Route::get('landing/news/data', ['as' => 'news.index', 'uses' => 'Landings\NewsController@index']);
    Route::get('landing/news/add', ['as' => 'news.add', 'uses' => 'Landings\NewsController@add']);
    Route::post('landing/news/store', ['as' => 'news.store', 'uses' => 'Landings\NewsController@store']);
    Route::get('landing/news/{id}/edit', ['as' => 'news.edit', 'uses' => 'Landings\NewsController@edit']);
    Route::get('landing/news/{id}/detail', ['as' => 'news.detail', 'uses' => 'Landings\NewsController@edit']);
    Route::post('landing/news/{id}/update', ['as' => 'news.update', 'uses' => 'Landings\NewsController@update']);
    Route::get('landing/news/{id}/delete', ['as' => 'news.delete', 'uses' => 'Landings\NewsController@delete']);


});
