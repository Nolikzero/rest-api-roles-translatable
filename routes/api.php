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

Route::group(['domain' => \App\Http\Localization\Localization::setLocalePrefix() . env('APP_DOMAIN')], function () {
    Route::group(['prefix' => 'api'], function () {
        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
            Route::post('register', 'RegisterController@register');
            Route::post('login', 'LoginController@login');
            Route::group(['middleware' => ['auth:api']], function () {
                Route::post('logout', 'LoginController@logout');
            });
        });

        Route::group(['namespace' => 'User', 'middleware' => ['auth:api']], function () {

            Route::apiResource('roles', 'Role\RoleController', [
                'only' => [
                    'index',
                    'show'
                ]
            ])->middleware('permission:roles.view');

            Route::apiResource('roles', 'Role\RoleController', [
                'except' => [
                    'index',
                    'show'
                ]
            ])->middleware('permission:roles.write.*');

            Route::apiResource('permissions', 'Role\PermissionController', [
                'only' => [
                    'index',
                    'show'
                ]
            ])->middleware('permission:roles.view');

            Route::apiResource('permissions', 'Role\PermissionController', [
                'except' => [
                    'index',
                    'show'
                ]
            ])->middleware('permission:roles.write.*');

            Route::apiResource('users', 'UserController', [
                'only' => [
                    'index',
                    'show'
                ]
            ])->middleware('permission:users.view');

            Route::apiResource('users', 'UserController', [
                'except' => [
                    'index',
                    'show'
                ]
            ])->middleware('permission:users.write.*');

            Route::get('permission/{permission}/roles', 'Role\PermissionRolesController@index');
            Route::post('permission/{permission}/roles', 'Role\PermissionRolesController@sync');

            Route::get('roles/{role}/permissions', 'Role\RolePermissionsController@index');
            Route::post('roles/{role}/permissions', 'Role\RolePermissionsController@sync');

            Route::get('users/{role}/permissions', 'UserPermissionsController@index');
            Route::post('users/{role}/permissions', 'UserPermissionsController@sync');

            Route::get('users/{role}/roles', 'UserRolesController@index');
            Route::post('users/{role}/roles', 'UserRolesController@sync');
        });

    });
});




