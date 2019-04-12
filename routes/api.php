<?php

use Illuminate\Http\Request;

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

Route::group([
    'prefix' => 'customers',
    'middleware' => ['auth:api','jsonx'],
], function(){
    Route::get('list', 'Api\V1\ClientsController@list');
    Route::post('listParams', 'Api\V1\ClientsController@listParams');
});

Route::group([
    'prefix' => 'orders',
    'middleware' => 'auth:api'
], function(){
    Route::get('list', 'Api\V1\OrdersController@list');
    Route::get('products', 'Api\V1\ProductsController@list');
    Route::get('totalProductsSold', 'Api\V1\OrdersController@totalProductsSold');
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});



use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', [], function (Router $api) {
    $api->get('hello',function(){
    return "Hello";});
});