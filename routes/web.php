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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/home', function () {
//     return view('home');
// });
// Route::get('/blog', 'API\PostsController@blog')->name('blog');
// Route::get('/blog', 'API\PostsController@blog');
// Route::resource('posts', 'PostsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/dashboard', 'HomeController@dashboard');
// Route::get('/{any}', 'HomeController@index')->where('any', '.*');
// Route::get('/{any}', 'HomeController@index')->where('any', '^(?!api).*$');

Route::get('{path}', "HomeController@index")->where( 'path', '([A-z\d\-\/_.]+)?');