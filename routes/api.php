<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/getUsers', 'UserController@getUsers')->name('getUser');
Route::post('/addUser', 'UserController@addUser')->name('addUser');
Route::post('/getUser', 'UserController@getUser')->name('getUser');
Route::post('/editUser', 'UserController@editUser')->name('editUser');
Route::post('/deleteUser', 'UserController@deleteUser')->name('deleteUser');
Route::post('/rollUsers', 'UserController@rollUsers')->name('rollUsers');