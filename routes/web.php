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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

$background = config('myconfig.background','admin');
Route::group(['prefix'=>$background,'namespace'=>'Admin','middleware'=>['auth','checktime']],function(){
	Route::get('/','AdminController@index');
	Route::get('/test',function(){
		echo 'nice';
	});
	Route::get('logout','AdminController@logout');
	Route::get('edit_myaccount','AdminController@edit_myaccount');
	Route::post('update_myaccount','AdminController@update_myaccount');

	// Route::resource('permission','PermissionController');
	Route::resource('player','PlayerController');
	Route::get('player_play','PlayerController@player_play');
});
