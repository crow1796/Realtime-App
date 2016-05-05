<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function(){
	Route::group(['middleware' => ['guest'], 'namespace' => 'Auth'], function(){
		Route::get('/login', 'AuthController@showLoginForm');
		Route::post('/login', 'AuthController@login');
		Route::get('/register', 'AuthController@showRegistrationForm');
		Route::post('/register', 'AuthController@register');
	});

	Route::get('/logout', 'Auth\AuthController@logout');

	Route::group(['middleware' => ['auth']], function(){
		Route::get('/', 'HomeController@index');

		Route::group(['prefix' => '/api'], function(){
			Route::get('/posts', 'PostController@index');
			Route::post('/post', 'PostController@store');
			Route::post('/comment', 'CommentsController@store');
		});
	});
});