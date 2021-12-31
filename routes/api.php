<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// All API here must be authenticated
Route::group(['middleware' => 'api', 'namespace' => 'Api'], function () {
    Route::get('restaurants', 'RestaurantController@index');
});
