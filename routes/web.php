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

Route::get('/', "Landing@index");
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/all','UserController@all');
Route::get('/users/{id}','UserController@show');
Route::get('/myprofile','UserController@myprofile')->middleware('auth')->name('myprofile');
Route::post('/subscribe/{id}','SubscribeController@subscribe')->middleware('auth');
Route::post('/unsubscribe/{id}','SubscribeController@unsubscribe')->middleware('auth');
Route::delete('/users/delete/{id}','UserController@delete')->middleware('auth');
Route::post('/articles/new','ArticlesController@create');
Route::get('/articles/new',function(Request $request){
   return view('new_article');
})->middleware('auth');
Route::post('/like/{type}/{id}','LikeController@like')->middleware('auth');
Route::delete('/unlike/{type}/{id}','LikeController@unlike')->middleware('auth');
Route::get('/article/{id}',"ArticlesController@show");
Route::post('/comment/add','CommentController@add');
Route::delete('/comment/delete/{id}',"CommentController@delete");
Route::get('/edit/{id}',"ArticlesController@showEdit")->middleware('auth');
Route::post('/edit/{id}','ArticlesController@edit')->middleware('auth');
Route::delete('/delete/{id}','ArticlesController@delete')->middleware('auth');
Auth::routes();
