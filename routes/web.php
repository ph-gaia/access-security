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

Route::get('/', "Admin\DashboardController@index");

Route::group(['middleware' => ['web']], function () {
    Route::resource('admin/application', 'Admin\ApplicationController');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('admin/groupaccess', 'Admin\GroupAccessController');
    Route::get('admin/groupaccess/delete/gpPermission/{group_access}/{permission}', 'Admin\GroupAccessController@removeGpPermissionAccess');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('admin/module', 'Admin\\ModuleController');
    Route::get('admin/module/delete/modulePermission/{module}/{permission}', 'Admin\ModuleController@removeModulePermissionAccess');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('admin/permission', 'Admin\\PermissionController');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('admin/auth', 'Admin\\AuthController');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('admin/users', 'Admin\\UsersController');
    Route::get('admin/users/delete/userPermission/{user}/{permission}', 'Admin\UsersController@removeUserPermissionAccess');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('admin/logging', 'Admin\\LoggingController');
});

Route::get('admin/dashboard', 'Admin\DashboardController@index');
Route::get('admin/login', 'Admin\\AuthController@login');
Route::post('admin/autentica', 'Admin\\AuthController@autentica');
Route::get('admin/logout', 'Admin\\AuthController@logout');
