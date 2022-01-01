<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;

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

//all routes / api here must be api authenticated
Route::group(['middleware' => 'api', 'namespace' => 'Api'], function () {
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::post('login', 'AuthController@login');

        Route::post('logout', 'AuthController@logout')->middleware(['auth.guard:admin-api']);
        //invalidate token security side

        //broken access controller user enumeration
        Route::post('profile', function () {
            return "admin";
            // return  \Auth::user(); // return authenticated user data
        })->middleware(['auth.guard:admin-api']);
    });

    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
        Route::post('login', 'AuthController@Login');
        Route::post('logout', 'AuthController@logout')->middleware(['auth.guard:user-api']);
        Route::post('/profile', function () {
            return  \Auth::user();
        });
    });

    Route::group(['prefix' => 'restaurant', 'middleware' => 'auth.guard:admin-api'], function () {
        // Route::post('restaurants', 'RestaurantController@index');
        Route::post('/restaurants', function () {
            if (!\Auth::user())
                return response()->json("Error");
            return "It's Ok";
        });
    });

    Route::group(['prefix' => 'orders', 'namespace' => 'Order', 'middleware' => 'auth.guard:api'], function () {
        Route::post('/', 'OrderController@index')->middleware(['auth.guard:admin-api']);
        Route::post('/submit', 'OrderController@submit');
        Route::post('/show', 'OrderController@show');
    });

    Route::group(['namespace' => 'SMS', 'middleware' => 'auth.guard:api'], function () {
        Route::post('/first_provider', 'SMSController@firstProvider');
        Route::post('/second_provider', 'SMSController@secondProvider');
    });
});
