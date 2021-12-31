<?php

use Illuminate\Support\Facades\Route;

// All API here must be authenticated
Route::group(['middleware' => ['api', 'checkPassword'], 'namespace' => 'Api'], function () {
    Route::post('restaurants', 'RestaurantController@index');
    Route::post('restaurant/{id}', 'RestaurantController@show');
});
