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

Auth::routes();
Route::get('/', 'PublicController@index')->name('public.index');
Route::get('/allevents', 'PublicController@allevents')->name('public.events');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/event', 'HomeController@event')->name('user.event');
Route::post('/event', 'HomeController@eventpost')->name('user.eventpost');
Route::get('/user/listevent', 'HomeController@listevent')->name('user.listevent');
Route::post('post-data', ['as' => 'UserPostManage', 'uses' => 'HomeController@userPostManage']);
Route::post('public-post-data', ['as' => 'PublicPostManage', 'uses' => 'PublicController@PublicPostManage']);
