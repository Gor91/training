<?php

use Illuminate\Support\Facades\Route;

/*
------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your aplication. These
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
        Route::match(['put', 'patch'], 'avatar/{id}', 'Frontend\AccountController@avatar');
        Route::match(['put', 'patch'], 'update/{id}', 'Frontend\AccountController@update');
        Route::match(['put', 'patch'], 'approve/{id}', 'Frontend\AccountController@editApprove');
        Route::post('me', 'Frontend\AuthController@me');
        Route::get('edit/{id}', 'Frontend\AccountController@editProfile');
        Route::match(['put', 'patch'], 'edit/{id}', 'Frontend\AccountController@updateProfile');
        Route::match(['put', 'patch'], 'changePass/{id}', 'Frontend\AccountController@changePassword');

    });
Route::group(['middleware' => 'cors'], function () {


});
Route::post('about', 'Frontend\PageController@about');
Route::post('coursestitle', 'Frontend\PageController@coursestitle');

Route::post('regions', 'Frontend\AddressController@index');
Route::get('prof', 'Frontend\ExpertController@profession');
Route::post('edu', 'Frontend\ExpertController@education');
Route::post('spec/{id}', 'Frontend\ExpertController@specialty');
Route::post('territory/{id}', 'Frontend\AddressController@territories');
//        Route::get('reset-password', 'AuthController@sendPasswordResetLink');
Route::post('reset-password', 'Frontend\PasswordResetController@sendPasswordResetLink');
Route::post('reset/password', 'Frontend\PasswordResetController@callResetPassword');


