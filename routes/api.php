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

Route::get('/balance', 'BalanceController@balance');
Route::post('/deposit', 'BalanceController@deposit');
Route::post('/withdraw', 'BalanceController@withdraw');
Route::post('/transfer', 'BalanceController@transfer');
