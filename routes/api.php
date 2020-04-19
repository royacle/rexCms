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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    
    return $request->user();
});

Route::middleware('auth:api')->get('/category', function (Request $request) {
    
    return $request->category();
});

Route::middleware('auth:api')->get('/post', function (Request $request) {
    
    return $request->post();
});

Route::apiResources(['user' => 'API\UserController']);

Route::apiResources(['category' => 'API\CategoriesController']);

Route::apiResources(['post' => 'API\PostsController']);

Route::get('profile', 'API\UserController@profile');

Route::get('findUser', 'API\UserController@search');

Route::get('findCategory', 'API\CategoriesController@search');

Route::put('profile', 'API\UserController@updateProfile');

Route::get('allCategories', 'API\CategoriesController@allCategories');

// Route::apiResources(['dashboard' => 'API\DashboardController']);