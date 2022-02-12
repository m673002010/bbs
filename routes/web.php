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

// 注册登录路由
Route::get('/register', "\App\Http\Controllers\RegisterController@index");
Route::post('/register', "\App\Http\Controllers\RegisterController@register");
Route::get('/login', "\App\Http\Controllers\LoginController@index");
Route::post('/login', "\App\Http\Controllers\LoginController@login");
Route::get('/logout', "\App\Http\Controllers\LoginController@logout");


// 文章路由
Route::get('/posts/search', "\App\Http\Controllers\PostController@search");

Route::get('/posts/create', "\App\Http\Controllers\PostController@create"); // create和show同路径，create需放前面
Route::post('/posts', "\App\Http\Controllers\PostController@store");
Route::get('/posts', "\App\Http\Controllers\PostController@index");
Route::get('/posts/{post}', "\App\Http\Controllers\PostController@show");
Route::get('/posts/{post}/edit', "\App\Http\Controllers\PostController@edit");
Route::put('/posts/{post}', "\App\Http\Controllers\PostController@update");
Route::get('/posts/{post}/delete', "\App\Http\Controllers\PostController@delete");

Route::post('/posts/{post}/comment', "\App\Http\Controllers\PostController@comment");

Route::get('/posts/{post}/zan', "\App\Http\Controllers\PostController@zan");
Route::get('/posts/{post}/unzan', "\App\Http\Controllers\PostController@unzan");

// 个人中心
Route::get('/user/me/setting', "\App\Http\Controllers\UserController@setting");
Route::post('/user/me/setting', "\App\Http\Controllers\UserController@settingStore");
Route::get('/user/{user}', "\App\Http\Controllers\UserController@show");
Route::get('/user/{user}/fan', "\App\Http\Controllers\UserController@fan");
Route::get('/user/{user}/unfan', "\App\Http\Controllers\UserController@unfan");

// 主题
Route::get('/topics/{topic}', "\App\Http\Controllers\TopicController@show");
Route::post('/topics/{topic}/submit', "\App\Http\Controllers\TopicController@submit");


// 管理后台
include_once("admin.php");