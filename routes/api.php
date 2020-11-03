<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1','namespace' => 'Api', 'as' => 'api.'], function() {
    Route::get('popiklan','PopiklanController@index')->name('iklan');
    Route::post('login', 'Account\LoginController@login')->name('login_member');
    Route::post('register', 'Account\RegisterController@register')->name('register');
    Route::get('bank', 'Invoices\BankController@getBank');
    Route::get('banner', 'Beranda\BerandaController@getBanner');
    Route::get('category', 'Products\CategoryController@getCategorySub');
    Route::get('product', 'Products\ProductController@getProduct');
    Route::get('product/detail/{id}', 'Products\ProductController@getProductDetail');

    Route::get('product/comment/{id}', 'Products\ProductController@product_comment');



    Route::get('provinces', ['as' => 'regions.provinces', 'uses' => 'RegionsController@provinces']);
    Route::get('cities', ['as' => 'regions.cities', 'uses' => 'RegionsController@cities']);
    Route::get('city', ['as' => 'regions.city', 'uses' => 'RegionsController@city']);
    Route::get('destination-city', ['as' => 'regions.destination.city', 'uses' => 'RegionsController@destinationCity']);

    Route::get('districts', ['as' => 'regions.districts', 'uses' => 'RegionsController@districts']);
    Route::get('destination-districts', ['as' => 'regions.destination-districts', 'uses' => 'RegionsController@destinationDistricts']);

    Route::get('pic', ['as' => 'customer.pic', 'uses' => 'CustomerController@pic']);

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('product/comment_private/{id}', 'Products\ProductController@product_comment_private');
        Route::get('inbox/product/list', 'Inbox\InboxProductController@list');
        Route::post('inbox/product/store', 'Inbox\InboxProductController@store');

        Route::get('inbox/order/list', 'Inbox\InboxOrderController@list');
        Route::post('inbox/order/store', 'Inbox\InboxOrderController@store');
        Route::get('inbox/order/detail/{id}', 'Inbox\InboxOrderController@detail');


        Route::get('order', 'Orders\OrderController@getOrder');
        Route::get('order/detail/{id}', 'Orders\OrderController@getOrderDetail');
        Route::post('order/store', 'Orders\OrderController@store');

        Route::get('invoice', 'Invoices\InvoiceController@getInvoice');
        Route::post('invoice/bayar', 'Invoices\InvoiceController@bayar');

        Route::get('account', 'Account\ProfileController@getAccont');
        Route::post('changepassword', 'Account\ProfileController@changepassword');

    });

});
