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
Route::group(['middleware' => ['api'/*,'checkPassword',*/], 'namespace' => 'Api'], function () {
    // Route::post('restaurants', 'RestaurantController@index');
    Route::post('get-category-byId', 'CategoriesController@getCategoryById');
    Route::post('change-category-status', 'CategoriesController@changeStatus');

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
            // return  "user";
            // $user = JWTAuth::parseToken()->authenticate();
            // if ((\Auth::user() != $user)) {
            //     return  response()->json("Error");
            // } else
            //     return  response()->json($user);
            if (!\Auth::user())
                return response()->json("Error");
            return "It's Ok";
        });
    });
});
