<?php

use Illuminate\Support\Facades\Route;
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

//Route::prefix('users')->group(function() {
//    Route::get('/', 'UserController@index');
//});
//
//
//Route::group(['middleware' => 'adminAuth'], function (){
//
//    //Admin users
//    Route::get('users', 'UserController@index')->middleware('can:users.index')->name('user.index');
//
//    Route::group(['middleware' => 'can:users.create'], function (){
//        Route::get('user/create', 'UserController@create')->name('user.create');
//    });
//
//    Route::group(['middleware' => 'can:users.edit'], function (){
//        Route::get('user/{id}/edit', 'UserController@edit')->name('user.edit');
//    });
//
//    //Roles
//    //Route::get('roles', 'RoleController@index')->middleware('can:roles.index')->name('role.index');
//
//    Route::group(['middleware' => 'can:roles.create'], function (){
//        Route::get('role/create', 'RoleController@create')->name('role.create');
//    });
//
//    Route::group(['middleware' => 'can:roles.edit'], function (){
//        Route::get('role/{id}/edit', 'RoleController@edit')->name('role.edit');
//    });
//
//
//    //Customer
//    Route::group(['middleware' => 'can:customers.create'], function () {
//        Route::post('customer/create', 'CustomerController@store')->name('customer.store');
//    });
//
//    Route::group(['middleware' => 'can:customers.edit'], function () {
//        Route::put('customer/{id}/edit', 'CustomerController@update')->name('customer.update');
//    });
//
//    Route::group(['middleware' => 'can:customers.block'], function () {
//        Route::post('customer/{id}/block', 'CustomerController@block')->name('customer.block');
//        Route::post('customer/{id}/unblock', 'CustomerController@unblock')->name('customer.unblock');
//    });
//
//    Route::get('main', 'AuthController@mainPage')->name('main');
//    Route::get('logout', 'AuthController@logout')->name('logout');
//});
//
//
//Route::get('login', 'AuthController@loginPage')->middleware('adminGuest')->name('loginPage');
//
//Route::post('login', 'AuthController@login')->middleware('check.blocked')->name('admin.login');


