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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ

//use Illuminate\Routing\Route;

Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/logout', 'Auth\LoginController@logout');

Route::get('/register', 'Auth\RegisterController@register'); //新規登録ページ
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added'); //新規登録成功ページ
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top', 'PostsController@index');
//表示用
//Route::post('/post/create','PostController@create');//->name('post,create');
//投稿を押したとき
Route::post('/post', 'PostController@store'); //->name('post,store');
Route::post('/top', 'PostsController@postCreate');
Route::get('/post/{id}/top', 'PostsController@Delete');

Route::get('/profile', 'UsersController@profile'); //プロフィー
Route::post('/profile/update', 'UsersController@update');

Route::get('/search', 'UsersController@search'); //検索ページ
Route::post('/search', 'UsersController@search');

Route::get('/follow-list', 'FollowsController@followList');
Route::get('/follower-list', 'FollowsController@followerList');

//フォロー機能
Route::post('/user/{id}/follow', 'UsersController@follow')->name('follow1');
//フォロー解除機能
Route::post('/user/{id}/nofollow', 'UsersController@nofollow')->name('follow2');
