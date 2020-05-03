<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{any}', 'Frontend\SinglePageController@index')->where('any', '.*');
Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
Route::get('/about', 'PageController@get');
Route::get('/contact', 'PageController@get');

\Illuminate\Support\Facades\Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


//backend
//Route::prefix('/backend')->
//name('backend.')
//    ->namespace('Auth')->group(function () {
Route::get('password/request', 'Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.request');
//Route::get('/home', 'Frontend\HomeController@index')->name('home');
Route::get('/backend', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/backend/login/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/backend/doLogin/', 'Auth\LoginController@doLogin')->name('doLogin');
Route::get('/backend/logout/', 'Auth\LoginController@logout')->name('logout');
Route::post('/backend/logout/', 'Auth\LoginController@logout')->name('logout');
//pages
Route::get('/backend/dashboard/', 'Backend\DashboardController@index')->name('dashboard');
Route::resource('/backend/admin', 'Backend\AdminController');
Route::match(['put', 'patch'],'/backend/changePassword/{id}', 'Backend\AdminController@changePassword');
Route::post('/backend/sendEmail', 'Backend\BaseController@sendEmail');





//generate pdf
Route::get('/backend/admin_gdPDF', 'Backend\AdminController@gdPDF');
Route::get('/backend/admin_gdExcel', 'Backend\AdminController@gdExcel');
//    });