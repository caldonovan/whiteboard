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

Route::get('posts/', 'PostController@apiIndex')->name('api.posts.index');

Route::get('comments/', 'CommentController@index')->name('api.comments.showAll');

// Show comments for particular post
Route::get('comments/{post_id}', 'CommentController@apiIndex')->name('api.comments.show');

// Store new comment on particular post
Route::post('comments/store', 'CommentController@apiStore')->name('api.comments.store')->middleware('auth:api');

// Update comment
Route::put('comments/update', 'CommentController@apiUpdate')->name('api.comments.update')->middleware('auth:api');

// Delete comment
Route::delete('comments/delete/{id}', 'CommentController@apiDelete')->name('api.comments.delete')->middleware('auth:api');
