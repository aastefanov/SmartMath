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
    Route::get('/category/{categoryId}', 'CategoriesController@getPreferredProblem');
});

// Admin panel
Route::group([
    'middleware' => ['auth', 'admin'],
    'namespace' => 'Admin',
    'prefix' => 'admin'
],function () {
    Route::get('/', 'IndexController@index');
    Route::resource('/users', 'UsersController');
    Route::resource('/categories', 'CategoriesController');
    Route::get('/problems/{id}', 'ProblemsController@edit');
    Route::get('/problems/create/{categoryId}', 'ProblemsController@createFromCategory');
    Route::post('/problems', 'ProblemsController@store');
    Route::put('/problems/{id}', 'ProblemsController@update');
    Route::delete('/problems/{id}', 'ProblemsController@delete');
});