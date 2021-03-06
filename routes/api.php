<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'Auth\AuthenticateControllerLogin@authenticate');
Route::post('login-refresh', 'Auth\AuthenticateControllerLogin@refreshToken');
Route::get('me', 'Auth\AuthenticateControllerLogin@getAuthenticatedUser');

Route::apiResource('User', 'Api\UserController');
Route::apiResource('Movement', 'Api\MovementController');
Route::apiResource('PersonalRecord', 'Api\PersonalRecordController');
Route::get('ranking', 'Api\PersonalRecordController@ranking');

