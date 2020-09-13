<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'UserController@index')->name('index');
Route::get('/profile/{id}', 'UserController@showProfile')->name('user.show');
Route::get('/configure/user/{id}', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getAvatar')->name('user.getAvatar');
Route::get('/recommended-users/', 'UserController@usersList')->name('user.recommended_users');
Route::post('/configure/user/{id}', 'UserController@save')->name('user.save');


//Images
Route::get('upload/image/', 'ImageController@index')->name('image.index');
Route::post('upload/image/{id}', 'ImageController@upload')->name('image.upload');
Route::get('image/detail/{filename}', 'ImageController@showImage')->name('image.detail');
Route::get('image/{filename}', 'ImageController@getImage')->name('image.show');

Auth::routes();

/* -- AJAX -- */
// Likes
Route::post('like', 'LikeController@index')->name('like.index');

// Follows
Route::post('follow', 'FollowerController@index')->name('follow.index');

// Comments
Route::post('image/comment', 'CommentController@save')->name('comment.save');
