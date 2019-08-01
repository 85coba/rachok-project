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
    Route::get('/user/settings', 'Api\UserSettingsController@getSettings');
    Route::post('/user/settings', 'Api\UserSettingsController@addSettings');
    Route::post('/order/add','Api\OrderController@addOrder');
    Route::get('/equipments','Api\EquipmentController@index');
    Route::delete('/remove/{id}', 'Api\OrderController@removeOrderFromUserList');
    Route::post('/process', 'Api\OrderController@processOrder');
    Route::post('/unprocess', 'Api\OrderController@unprocessOrder');
    Route::get('/isprocessed/{id}', 'Api\OrderController@isProcessed');
    Route::group([
        'middleware' => 'auth:api',
        'namespace' => 'Api\\'
    ], function(){
        Route::group(['prefix' => 'order'], function(){
            Route::get('/all', 'OrderController@getOrderCollection');
            Route::get('/removed', 'OrderController@getRemovedOrders');
            Route::get('/processed', 'OrderController@getProcessedOrders');
            Route::get('/unprocessed', 'OrderController@getUnProcessedOrders');
            
        });

    });
    
});
