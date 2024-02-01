<?php
use \Illuminate\Routing\Router;

Route::group(['namespace' => 'Auth','as' => 'backend.'], function (Router $router) {
    $router->get('login', 'LoginController@showLoginForm')->name('show.login.form');
    $router->post('auth/login', 'LoginController@login')->name('auth.login');
    $router->post('logout', 'LoginController@logout')->name('auth.logout');
});

Route::group(['middleware' => ['auth:admin'],'as' => 'backend.'], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
    Route::get('getPersonInvoices', 'UserController@getPersonInvoices')->name('getPersonInvoices');
    Route::get('reports/daily', 'ReportController@getDaily')->name('reports.daily');
    Route::get('reports/sales', 'ReportController@getSales')->name('reports.sales');
    Route::get('reports/minus', 'ReportController@getMinus')->name('reports.minus');
    Route::get('reports/decors', 'ReportController@getDecorsReport')->name('reports.decors');
    Route::get('orders/activity-log/{order}', 'OrderController@activityLog')->name('orders.activityLog');

    Route::group(['middleware' => 'authorize'], function (Router $router) {
        $router->resource('users', 'UserController')->except('show');
        $router->resource('roles', 'RoleController')->except('show');
        $router->resource('clients', 'ClientController');
        $router->resource('payments', 'PaymentController');
        $router->resource('category', 'CategoryController')->except('show');
        $router->resource('buffetcategory', 'BuffetCategoryController');
        $router->resource('items', 'ItemController');
        $router->resource('orders', 'OrderController');
        $router->resource('buffets', 'BuffetController')->except('show');
        $router->resource('contracts', 'ContractController')->except('show');
        $router->resource('pages', 'PageController')->except('show');
        $router->resource('gallery', 'GalleryController')->except('show');
        $router->resource('departments', 'DepartmentController')->except('show');
        $router->resource('tasks', 'TaskController')->except('show');
        $router->resource('sliders', 'SliderController')->except('show');
        $router->any('orders/changeStatus/{order}','OrderController@changeStatus')->name('orders.changeStatus');
        $router->any('orders/assignTask/{order}','OrderController@assignTask')->name('orders.assignTask');
        $router->get('payments/orders/{order}','PaymentController@show')->name('payments.show');




    });
    $router->resource('ordertasks', 'OrderTaskController')->except('show','create','store');
});
