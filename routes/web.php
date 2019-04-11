<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/products/{product}', 'ProductController@show')->name('products.show');

Route::get('/order', 'OrderController@index')->name('order.index');
Route::get('/order/{hash}', 'OrderController@show')->name('order.show');
Route::post('/order', 'OrderController@store')->name('order.store');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::get('/cart/add/{slug}/{quantity}', 'CartController@add')->name('cart.add');
Route::post('/cart/update/{slug}', 'CartController@update')->name('cart.update');

Route::get('/braintree/token', 'BraintreeController@token')->name('braintree.token');

