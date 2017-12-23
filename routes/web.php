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

#Route::get('/', function () {
#    return view('welcome');
#});

//Route::get('/', 'StaticPagesController@home');
//Route::get('/help', 'StaticPagesController@help');
//Route::get('/about', 'StaticPagesController@about');


//Route::get('/wx/check/', 'WeixinController@checkSignature');
//Route::get('/wx/getAccessToken/', 'WeixinController@getAccessToken');

//Route::get('/test', 'TestController@index');

Route::group(
	array('prefix' => 'wx', 'middleware' => []), function() {
		Route::get('check', 'WeixinController@checkSignature');
		Route::get('getAccessToken', 'WeixinController@getAccessToken');
	}
);
