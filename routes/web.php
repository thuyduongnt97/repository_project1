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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'role:developer'], function() {
    Route::get('/admin', function() {
       return 'Welcome Admin';
    });
});

// Quản lý role thêm sửa xóa
Route::prefix('/role')->group(function () {
    Route::get('/', 'RoleController@index')->name('role.index');
    Route::post('/create', 'RoleController@create')->name('role.create');
    Route::post('/update', 'RoleController@update')->name('role.update');
    Route::post('/delete', 'RoleController@delete')->name('role.delete');
});
Route::prefix('/permission')->group(function () {
    Route::get('/', 'PermissionController@index')->name('permission.index');
    Route::post('/create', 'PermissionController@create')->name('permission.create');
    Route::post('/update', 'PermissionController@update')->name('permission.update');
    Route::post('/delete', 'PermissionController@delete')->name('permission.delete');
});
Route::prefix('/role-permission')->group(function () {
    Route::get('/', 'RolePermissionController@index')->name('role-permission.index');
});
Route::prefix('user')->group(function () {
    Route::get('/', 'UserController@index')->name('user.index');
});
