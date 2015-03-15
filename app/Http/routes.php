<?php

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('/posts', 'PostController');
Route::resource('/comments', 'CommentController');
Route::resource('/users', 'UserController');

Route::get('/posts/{id}/comments', 'PostController@getComments');