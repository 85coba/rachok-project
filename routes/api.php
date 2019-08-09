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
    Route::get('/user/settings', 'Api\UserSettingsController@getSettings')->middleware('auth:api');
    Route::post('/user/settings', 'Api\UserSettingsController@addSettings')->middleware('auth:api');
    Route::post('/order/add','Api\OrderController@addOrder');
    Route::get('/equipments','Api\EquipmentController@index');
    Route::group([
        'middleware' => 'auth:api',
        'namespace' => 'Api\\'
    ], function(){
        Route::group(['prefix' => 'order'], function(){
            Route::get('/all', 'OrderController@getOrderCollection');
            Route::get('/removed', 'OrderController@getRemovedOrders');
            Route::get('/processed', 'OrderController@getProcessedOrders');
            Route::get('/unprocessed', 'OrderController@getUnProcessedOrders');
            Route::delete('/remove/{id}', 'OrderController@removeOrderFromUserList');
            Route::post('/process', 'OrderController@processOrder');
            Route::post('/unprocess', 'OrderController@unprocessOrder');
            
        });

    });
    
});
