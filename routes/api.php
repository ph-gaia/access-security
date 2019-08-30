<?php
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

// route for api application
Route::group(['middleware' => ['jwtAuth']], function () {
    Route::get('/v1/application', 'Api\\ApplicationController@index');
    Route::get('/v1/application/{id}', 'Api\\ApplicationController@show');
    Route::post('/v1/application', 'Api\\ApplicationController@store');
    Route::put('/v1/application/{id}', 'Api\\ApplicationController@update');
    Route::delete('/v1/application/{id}', 'Api\\ApplicationController@delete');
});

// route for api group access
Route::group(['middleware' => ['jwtAuth']], function () {
    Route::get('/v1/groupaccess', 'Api\\GroupAccessController@index');
    Route::get('/v1/groupaccess/{id}', 'Api\\GroupAccessController@show');
    Route::post('/v1/groupaccess', 'Api\\GroupAccessController@store');
    Route::put('/v1/groupaccess/{id}', 'Api\\GroupAccessController@update');
    Route::delete('/v1/groupaccess/{id}', 'Api\\GroupAccessController@delete');
});

// route for api module
Route::group(['middleware' => ['jwtAuth']], function () {
    Route::get('/v1/module', 'Api\\ModuleController@index');
    Route::get('/v1/module/{id}', 'Api\\ModuleController@show');
    Route::post('/v1/module', 'Api\\ModuleController@store');
    Route::put('/v1/module/{id}', 'Api\\ModuleController@update');
    Route::delete('/v1/module/{id}', 'Api\\ModuleController@delete');
});

// route for api permission
Route::group(['middleware' => ['jwtAuth']], function () {
    Route::get('/v1/permission', 'Api\\PermissionController@index');
    Route::get('/v1/permission/{id}', 'Api\\PermissionController@show');
    Route::post('/v1/permission', 'Api\\PermissionController@store');
    Route::put('/v1/permission/{id}', 'Api\\PermissionController@update');
    Route::delete('/v1/permission/{id}', 'Api\\PermissionController@delete');
});

// route for api users
Route::group(['middleware' => ['jwtAuth']], function () {
    Route::get('/v1/users', 'Api\\UsersController@index');
    Route::get('/v1/users/{id}', 'Api\\UsersController@show');
    Route::put('/v1/users/{id}', 'Api\\UsersController@update');
    Route::delete('/v1/userss/{id}', 'Api\\UsersController@delete');
});
Route::post('/v1/users', 'Api\\UsersController@store');

// route for api auth
Route::group(['middleware' => ['jwtAuth']], function () {
    Route::post('/v1/auth/verify', 'Api\\AuthController@verify');
});
Route::group(['middleware' => ['api']], function () {
    Route::post('/v1/auth', 'Api\\AuthController@login');
});
