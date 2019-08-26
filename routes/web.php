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
Route::group(['prefix' => 'admin', 'namespace' => 'Admin\\', 'middleware'=>['web','authweb:web']], function () {
    Route::get('/', 'AdminController@index');
    Route::get('/users', 'AdminController@users');
    Route::get('/permissions', 'AdminController@permissions');
});



