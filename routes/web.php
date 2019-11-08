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
Route::get('/', 'PagesController@index');

Route::get('/modules', 'PagesController@modules');

Route::resource('posts', 'PostsController');

Route::resource('modules', 'ModulesController');

Route::resource('comments', 'CommentsController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
