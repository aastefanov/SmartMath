<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Dashboard and auth
Route::get('/', 'IndexController@index');
Route::get('/dashboard', 'HomeController@dashboard');
Auth::routes();

// User
Route::group([
    'middleware' => 'auth'
], function () {
    Route::get('/profile', 'ProfileController@index');
});

// Admin panel
Route::group([
    'middleware' => ['auth', 'admin'],
    'namespace' => 'Admin',
    'prefix' => 'admin'
],function () {
    Route::get('/profile/{id}', 'UsersController@viewProfile');

    Route::resource('/categories', 'CategoriesController');
});