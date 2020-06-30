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

Route::get('/', function () {
    return redirect('/posts');
});

Route::get('/home', function () {
    return redirect('/posts');
});

Auth::routes();

// post api
Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts/show/{post_id}', 'PostController@show')->name('posts.show');
Route::get('/posts/create', 'PostController@create')->name('posts.create');
Route::post('/posts', 'PostController@store')->name('posts.store');
Route::get('/posts/edit/{post_id}', 'PostController@edit')->name('posts.edit');
Route::patch('/posts', 'PostController@update')->name('posts.update');
Route::get('/posts/delete/{post_id}', 'PostController@destroy')->name('posts.destroy');
