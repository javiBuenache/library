<?php

use Illuminate\Http\Request;
use  App\Http\Middleware\CheckAuth;

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

Route::apiResource('users', 'UserController');
Route::post('login', 'UserController@login');

Route::group(['middleware' => ['auth']], function () 
{
    Route::apiResource('books', 'BookController');    
    Route::post('lend','UserController@lend');
});
