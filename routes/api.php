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

// List Comments
Route::get('comments', 'CommentController@index');

// Create Comment
Route::get('comment', 'CommentController@apiStore');

// List Posts
Route::get('posts', 'PostController@apiIndex')->name('api.posts.index');

// Show Post
Route::get('posts/{id}', 'PostController@apiShow');
