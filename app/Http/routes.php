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

Route::get('/', "ProblemController@index");
Route::get('/problem/{id}', "ProblemController@detail");
Route::get('/problem/{id}/submit', ['middleware' => 'auth', 'uses' => "ProblemController@submitForm"]);
Route::post('/problem/{id}/submit', ['middleware' => 'auth', 'uses' => "ProblemController@submit"]);

Route::get('/status', "StatusController@index");
Route::get('/status/problem/{id}', "StatusController@problem");

Route::get('/user/register', 'Auth\AuthController@getRegister');
Route::post('/user/register', 'Auth\AuthController@postRegister');

Route::get('/user/login', 'Auth\AuthController@getLogin');
Route::get('/user/logout', 'Auth\AuthController@getLogout');
Route::post('/user/login', 'Auth\AuthController@postLogin');
