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
Route::group(['middleware' => 'role:ManagerCampaign'], function() {
    Route::get('/admin', function() {
       return 'Welcome Admin';
    });
});

// Quản lý role thêm sửa xóa
Route::group(['prefix'=>'/role'],function () {
    Route::get('/', 'RoleController@index')->name('role.index');
    Route::post('/create', 'RoleController@create')->name('role.create');
    Route::post('/update', 'RoleController@update')->name('role.update');
    Route::post('/delete', 'RoleController@delete')->name('role.delete');
});
Route::group(['prefix'=> '/permission'],function () {
    Route::get('/', 'PermissionController@index')->name('permission.index');
    Route::post('/create', 'PermissionController@create')->name('permission.create');
    Route::post('/update', 'PermissionController@update')->name('permission.update');
    Route::post('/delete', 'PermissionController@delete')->name('permission.delete');
});
Route::group(['prefix'=>'/role-permission', 'middleware' => 'role:ManagerUser'],function () {
    Route::get('/', 'RolePermissionController@index')->name('role-permission.index');
    Route::post('/update', 'RolePermissionController@update')->name('role-permission.update');
});

Route::group(['prefix' => '/user-role','middleware' => 'role:ManagerCampaign'] ,function () {
    Route::get('/', 'UserRoleController@index')->name('user-role.index');
    Route::post('/add', 'UserRoleController@add')->name('user-role.add');
    Route::post('/delete', 'UserRoleController@delete')->name('user-role.delete');
});
Route::group(['prefix' => '/user'], function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::post('/create', 'UserController@create')->name('user.create');
});
