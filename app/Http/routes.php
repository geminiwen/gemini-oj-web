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
Route::get('/problem/{id}/status', "StatusController@problem");

Route::get('/user/register', 'Auth\AuthController@getRegister');
Route::post('/user/register', 'Auth\AuthController@postRegister');

Route::get('/user/login', 'Auth\AuthController@getLogin');
Route::get('/user/logout', 'Auth\AuthController@getLogout');
Route::post('/user/login', 'Auth\AuthController@postLogin');

Route::get("/contest", 'ContestController@index');

Route::get("/contest/{id}", [
    'middleware' => ['auth', 'contest.startTime', 'contest'],
    'uses' => 'ContestController@detail'
]);
Route::get("/contest/{id}/status", 'ContestController@status');
Route::get("/contest/{id}/problem/{pid}/status", 'ContestController@problemStatus');

Route::get("/contest/{id}/problem/{pid}", [
    'middleware' => ['auth', 'contest', 'contest.startTime'],
    'uses' => 'ContestController@problem'
]);

Route::get("/contest/{id}/problem/{pid}/submit", [
    'middleware' => ['auth', 'contest', 'contest.startTime', 'contest.endTime'],
    'uses' => 'ContestController@submitForm'
]);
Route::post("/contest/{id}/problem/{pid}/submit", [
    'middleware' => ['auth', 'contest', 'contest.startTime', 'contest.endTime'],
    'uses' => 'ContestController@submit']);

Route::get("/contest/{id}/ranklist", 'ContestController@ranklist');

Route::get("/contest/{id}/decrypt", [
    'middleware' => ['auth'],
    'uses' => 'ContestController@decryptForm'
]);
Route::post("/contest/{id}/decrypt", [
    'middleware' => ['auth'],
    'uses' => 'ContestController@decrypt'
]);
