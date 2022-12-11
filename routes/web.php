<?php

use \Illuminate\Routing\Router;

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

Route::group(['namespace' => 'Auth', 'as' => 'frontend.'], function (Router $router) {
    $router->post('login', 'LoginController@login')->name('login');
    $router->post('register', 'RegisterController@register')->name('register');
    $router->post('logout', 'LoginController@logout')->name('logout');
});
Route::group(['middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect'],
    'prefix' => LaravelLocalization::setLocale(), 'as' => 'frontend.'], function (Router $router) {
    //Auth::routes();
    $router->get('login', 'Auth\LoginController@showLoginForm')->name('showLoginForm');
    $router->get('register', 'Auth\RegisterController@showRegistrationForm')->name('showRegistrationForm');
    $router->get('thanks','CartController@thanks')->name('thanks');
    $router->get('/', 'HomeController@index')->name('home');
    $router->post('addToCart', 'CartController@addToCart')->name('cart.add');
    $router->post('updateCart', 'CartController@update')->name('cart.update');
    $router->get('showCart', 'CartController@show')->name('cart.show');
    $router->get('page/{slug}', 'HomeController@getPage')->name('page');
    $router->get('buffets/{category_id}', 'HomeController@getBuffet')->name('getBuffet');
    $router->get('buffet/{b_id}', 'HomeController@getBuffetDetails')->name('getBuffetDetails');
    $router->get('product/{id}', 'HomeController@product')->name('product.show');
    $router->any('removeItemCart/{productId?}', 'CartController@remove')->name('cart.remove');
    $router->get('destroyCart', 'CartController@destroy')->name('cart.destroy');
    $router->group(['middleware' => ['auth:web']],function(){
        Route::any('profile', 'AccountController@profile')->name('profile');
        Route::any('orders', 'AccountController@orders')->name('orders');
        Route::any('order/detailes/{id}', 'AccountController@detailes')->name('order.show');
        Route::any('checkout', 'CartController@checkout')->name('checkout');
    });
    $router->get('services', 'HomeController@services')->name('services');
    $router->get('about', 'HomeController@about')->name('about');
    $router->any('contact', 'HomeController@contact')->name('contact');
    $router->get('items','ItemController@list')->name('list');
});
