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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', [], function (Router $api) {
    $api->get('conferences', 'App\Http\Controllers\Api\V1\ConferenceController@index');
});