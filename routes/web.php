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

// * Routing for top level pages
Route::get('/', 'PageController@index');

Route::get('/modules', 'PageController@modules');

Route::resource('posts', 'PostController');

Route::resource('modules', 'ModuleController');

Route::resource('comments', 'CommentController');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');