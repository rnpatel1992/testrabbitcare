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

Route::group(['namespace' => 'App\Http\Controllers\Api\V1\Client'], function () {
    
    Route::group(['middleware' => 'api_token'],function ()
    {
        Route::apiResource('short-url', 'ShortUrlController')->only(['store']); // we can define single route but using apiResource for future purpose, 
    });
});


Route::group(['namespace' => 'App\Http\Controllers\Api\V1\Admin'], function () {
    Route::group(['prefix' => 'admin','middleware' => 'admin_api_token'],function ()
    {
        Route::apiResource('short-url', 'ShortUrlController')->only(['index','destroy']);
    });
});

