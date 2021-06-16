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

//Users
Route::get('users', 'UserController@index');
Route::post('user/create', 'UserController@store');

//Route::group(['middleware' => 'permission:users-edit'], function (){
//});

Route::get('user/{id}/edit', 'UserController@edit');
Route::put('user/{id}/edit', 'UserController@update');

Route::post('user/{id}/toggleBlock', 'UserController@toggleBlock');

//Roles
Route::get('roles', 'RoleController@index');
Route::post('role/create', 'RoleController@store');

//Route::group(['middleware' => 'permission:roles-edit'], function (){
//});

Route::get('role/{id}/edit', 'RoleController@edit');
Route::put('role/{id}/edit', 'RoleController@update');

Route::delete('role/{id}/delete', 'RoleController@destroy');

//Permissions
Route::get('permissions', 'PermissionController@index');

//Customers
Route::get('customers', 'CustomerController@index');
Route::post('customer/create', 'CustomerController@store');
Route::get('customer/{id}/edit', 'CustomerController@edit');
Route::put('customer/{id}/edit', 'CustomerController@update');
Route::post('customer/{id}/block', 'CustomerController@block');
Route::post('customer/{id}/unblock', 'CustomerController@unblock');
Route::get('customer/block-reasons','CustomerController@customerBlockReasons');
Route::post('customer/{id}/avatar/delete','CustomerController@deleteAvatar');

Route::post('logout', 'AuthController@logout');

Route::get('checkUser', 'AuthController@checkUser');

Route::post('login', 'AuthController@login')->middleware('check.blocked');
Route::post('reset-password', 'AuthController@resetPassword');



