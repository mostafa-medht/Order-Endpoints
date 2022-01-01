<?php

use Illuminate\Support\Facades\Route;

// All API here must be authenticated
Route::group(['middleware' => 'api', 'namespace' => 'Api'], function () {
    Route::post('restaurants', 'RestaurantController@index');
    Route::post('restaurant/{id}', 'RestaurantController@show');

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout')->middleware('auth.guard:admin-api');
    });
});

// All API here must be authenticated & User Role Is Admin
Route::group(['middleware' => ['api', 'checkPassword', 'checkAdminToken:admin-api'], 'namespace' => 'Api'], function () {
    Route::post('restaurants', 'RestaurantController@index');
});
