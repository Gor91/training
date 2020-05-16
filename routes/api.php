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

Route::group(['prefix' => 'auth'],
    function ($router) {

    Route::post('register', 'Frontend\AuthController@register');
    Route::post('login', 'Frontend\AuthController@login');
    Route::post('logout', 'Frontend\AuthController@logout');
    Route::post('refresh', 'Frontend\AuthController@refresh');
    Route::post('me', 'Frontend\AuthController@me');

});

Route::post('about', 'Frontend\PageController@about');
