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

Auth::routes();

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::resource('users', 'UserController')->only([
  'create', 'store','edit', 'update', 'show',
]);

Route::resource('posts', 'PostController');

Route::resource('follows', 'FollowController')->only([
  'index', 'store', 'destroy'
]);
 
Route::get('/follower', 'FollowController@followerIndex');

Route::get('/posts/search', 'PostController@search')->name('posts.search');