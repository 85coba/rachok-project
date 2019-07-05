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

Route::prefix('v1')->group(function () {
    Route::group(['prefix' => 'auth', 'namespace' => 'Api\\Auth'], function () {
        Route::post('/register', 'AuthController@register');
        Route::post('/login', 'AuthController@login');
        Route::get('/me', 'AuthController@me');
        Route::put('/me', 'AuthController@update');
        Route::post('/me/image', 'AuthController@uploadProfileImage');
        Route::post('/logout', 'AuthController@logout');
        Route::post('/reset/password', 'AuthController@callResetPassword');
        Route::post('/reset-password', 'AuthController@sendPasswordResetLink');
    });
    Route::group([
        'middleware' => 'auth:api',
        'namespace' => 'Api\\'
    ], function(){
        Route::group(['prefix' => 'order'], function(){
            Route::post('/add','OrderController@addOrder');
            Route::get('/all','OrderController@getOrderCollection');
        });

    });
    
});
