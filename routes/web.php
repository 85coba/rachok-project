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

Route::get('/', function () {
    return view('pages.login');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin\\', 'middleware'=>['web','authweb:web']], function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('/users', 'AdminController@users')->name('users');
    Route::get('/permissions', 'AdminController@permissions')->name('permissions');
    Route::get('/equipments', 'EquipmentController@index')->name('equipment.index');
    Route::get('/equipments/create', 'EquipmentController@create')->name('equipment.create');
    Route::post('/equipments/store', 'EquipmentController@store')->name('equipment.store');
});



